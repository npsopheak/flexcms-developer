<?php namespace FlexCMS\BasicCMS\Api;

use \Input;
use \Hash;
use \Uuid;
use FlexCMS\BasicCMS\Models\Item;
use FlexCMS\BasicCMS\Models\User;
use FlexCMS\BasicCMS\Models\DirectoryUser;
use \Auth;
use \DateTime;
use \DateInterval;

class UserController extends ApiController {

	public function index(){
		try{
            
			$items = [];
			$items = User::whereRaw('1 = 1');
			
			$name = Input::get('name');
			if ($name != null){
				$items = $items->whereRaw('name = ?', [$name]);
			}
			if (\Input::get('q')){
				$items = $items->whereRaw("name like ? OR email LIKE ? OR role LIKE ?", 
					['%' . Input::get('q') . '%', '%' . Input::get('q') . '%', '%' . Input::get('q') . '%']);
			}

			$items = $items->with('directory');

			$total = count($items->get()->toArray());

			if (Input::get('ignore-offset') != 1){
				$items = $items->take(Input::get('limit') ? Input::get('limit') : 20);
				$items = $items->skip(Input::get('offset') ? Input::get('offset') : 0);
			}
			
			$items = $items->get()->toArray();
			
			return $this->ok($items, ['count' => $total, 'limit' => Input::get('limit') ? Input::get('limit') : 20, 'offset' => Input::get('offset') ? Input::get('offset') : 0]);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function show($id){
		try{
			$item = User::find($id);
			if (!$item){
				throw new \Exception('The item cannot be found to update');
			}
			return $this->ok($item);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}


	public function showMe(){
		return $this->show(Auth::user()->id);
	}

	public function store(){
		try{
			$data = Input::all();
			$validation = \Validator::make($data, [
	            'name' => 'required|max:255',
	            'email' => 'required|max:255|unique:users',
	            'password' => 'required'
	        ]);
	        if ($validation->passes()){
                $data['password'] = \Hash::make($data['password']);
	        	// $data['created_by'] = Auth::user()->id;
	        	// $data['updated_by'] = Auth::user()->id;
	        	$item = User::create($data);
	        	return $this->ok($item);
	        }
	        else{
	        	return $this->error($validation->messages(), 'validation-error');
	        }
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function update($id){
		try{
            if ($id == 'me'){
                $id = Auth::user()->id;
            }
            else{

                if (Auth::user()->role != 'admin'){
                    throw new \Exception('You do not have permission to update');
                }
            }
			$item = User::find($id);
			if (!$item){
				throw new \Exception('The item cannot be found to update');
			}
			if (Input::get('name')){
				$item->name = Input::get('name');
			}
			if (Auth::user()->role == 'admin'){
				if (Input::get('role')){
					$item->role = Input::get('role');
				}
			}
			if (Input::get('email')){
                $existing = User::where('email', '=', Input::get('email'))
                    ->where('id', '!=', $item->id)->get()->toArray();
                if (count($existing) > 0){
                    throw new \Exception('Email is already taken');
                }
				$item->email = Input::get('email');
			}	
	        // $item->updated_by = Auth::user()->id;
			$item->save();
			return $this->ok($item);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroy($id){
		try{

            if (Auth::user()->role != 'admin'){
                throw new \Exception('You do not have permission to remove');
            }

			$item = User::find($id);

			if (!$item){
				throw new \Exception('The item cannot be found to delete');
			}	

			$item = $item->delete();
			return $this->ok(['id' => $id]);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function changePassword($id){
		try{
            if ($id == 'me'){
                $id = Auth::user()->id;
            }
            else{

                if (Auth::user()->role != 'admin'){
                    throw new \Exception('You do not have permission to change password');
                }
            }

            $item = User::find($id);
			if (!$item){
				throw new \Exception('User cannot be found to change password');
			}

            $data = Input::all();
			$validation = null;
			if (Auth::user()->role == 'admin' && false){

				$validation = \Validator::make($data, [
					'password' => 'required|confirmed',
					'password_confirmation' => 'required'
				]);
			}
			else{

				$validation = \Validator::make($data, [
					'password' => 'required|confirmed',
					'password_confirmation' => 'required',
					'old_password' => 'required'
				]);
			}
	        if ($validation->passes()){

				if (Auth::user()->role !== 'admin' || true ){
					if (\Hash::check($data['old_password'], $item->password)) {
						$data['password'] = \Hash::make($data['password']);
					}else{
						return $this->error('Password did not match', 'validation-error');
					}
				}
	        	
                $item->password = $data['password'];
                $item->save();
			    return $this->ok($item);
	        }
	        else{
	        	return $this->error($validation->messages(), 'validation-error');
	        }

			
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function assignDirectoryMember($id){
		try{
            if ($id == 'me'){
                throw new \Exception('You do not have permission to assign yourself');
            }
            else{

                if (Auth::user() != 'admin'){
                    throw new \Exception('You do not have permission to remove');
                }
            }

            $item = User::find($id);
			if (!$item){
				throw new \Exception('User cannot be found to change password');
			}

            $data = Input::all();
			$validation = \Validator::make($data, [
	            'directory_id' => 'required|exists:directories,id'
	        ]);
	        if ($validation->passes()){

                $tmp = DirectoryUser::where('user_id', '=', $id)->get();
                
                if ($tmp){
                    $tmp->updated_by = Auth::user()->id;
                    $tmp->directory_id = $data['directory_id'];
                    $tmp->save();

                    return $this->ok($tmp);
                }
                $tmp = DirectoryUser::create([
                    'user_id' => $id,
                    'directory_id' => $data['directory_id'],
                    'is_active' => 1,
                    'name' => $item->name,
                    'role' => 'admin',
                    'created_by' => Auth::user()->id
                ]);
	        	
			    return $this->ok($tmp);
	        }
	        else{
	        	return $this->error($validation->messages(), 'validation-error');
	        }

			
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
    }

	public function unassignDirectoryMember($id){
		try{
            if ($id == 'me'){
                throw new \Exception('You do not have permission to assign yourself');
            }
            else{

                if (Auth::user() != 'admin'){
                    throw new \Exception('You do not have permission to remove');
                }
            }

            $item = User::find($id);
			if (!$item){
				throw new \Exception('User cannot be found to change password');
			}

            $data = Input::all();
			$validation = \Validator::make($data, [
	            'directory_id' => 'required|exists:directories,id'
	        ]);
	        if ($validation->passes()){

                $tmp = DirectoryUser::where('user_id', '=', $id)->get();
                
                if ($tmp){
                    $tmp->directory_id = null;
                    return $this->ok($tmp);
                }
                return $this->ok('There is nothing to unassign');
	        }
	        else{
	        	return $this->error($validation->messages(), 'validation-error');
	        }

			
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
    }

}
