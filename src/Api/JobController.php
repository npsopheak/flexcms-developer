<?php namespace FlexCMS\BasicCMS\Api;

use \Input;
use \Hash;
use \Uuid;
use FlexCMS\BasicCMS\Models\Job;
use FlexCMS\BasicCMS\Models\JobApplication;
use \Auth;
use \DateTime;
use \DateInterval;

class JobController extends GenericController {

	// JOB 

	public function indexJob(){
		try{
			$genericClass = "\\FlexCMS\\BasicCMS\\Models\\Job";
			return $this->indexGeneric($genericClass, function ($query) {
				// $query = $query->with('role');
				// \Log::info('Logging donor generic');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showJob($id){
		try{
			$genericClass = "\\FlexCMS\\BasicCMS\\Models\\Job";
			return $this->showGeneric($genericClass, $id, function ($query) {
				// $query = $query->with('role');
				// \Log::info('Logging User generic show');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeJob(){
		try{
			$data = Input::all();
			// $validation = \Validator::make($data, [
	        //     'name' => 'required|max:255',
	        //     'email' => 'required|max:255|unique:users',
	        //     'password' => 'required'
	        // ]);
	        // if ($validation->passes()){
                
	        // }
	        // else{
	        // 	return $this->error($validation->messages(), 'validation-error');
	        // }
			
			$genericClass = "\\FlexCMS\\BasicCMS\\Models\\Job";
			return $this->storeGeneric($genericClass, function ($item) use ($data){
				// \Log::info('Logging User generic store');
	        	// $user = User::create([
				// 	'name' => $data['name'],
				// 	'email' => $data['email'],
				// 	'role' => 'member',
				// 	'password' => \Hash::make($data['password']),
				// 	// 'role_id' => isset($data['role_id']) ? $data['role_id'] : ''
				// ]);
	        	// $item['user_id'] = $user->id;

				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateJob($id){
		try{
			$genericClass = "\\FlexCMS\\BasicCMS\\Models\\Job";
			return $this->updateGeneric($genericClass, $id, function ($item) {
				// \Log::info('Logging User generic update');
				// if (\Input::get('name') != null){
				// 	$item->name = \Input::get('name');
				// }
				// if (\Input::get('role_id') != null){
				// 	$item->role_id = \Input::get('role_id');
				// }
				// $user = User::find($item->user_id);
				// if (!$user){
				// 	throw new \Exception('The user cannot be found to update');
				// }
				// if (Input::get('name')){
				// 	$user->name = Input::get('name');
				// }

				// if (Input::get('email')){
				// 	$existing = User::where('email', '=', Input::get('email'))
				// 		->where('id', '!=', $user->id)->get()->toArray();
				// 	if (count($existing) > 0){
				// 		throw new \Exception('Email is already taken');
				// 	}
				// 	$user->email = Input::get('email');
				// }	

				// if (\Input::get('password') != null){
				// 	$user->password = \Hash::make(\Input::get('password'));
				// }
				// // $user->updated_by = Auth::user()->id;
				// $user->save();
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyJob($id){
		try{
			$genericClass = "\\FlexCMS\\BasicCMS\\Models\\Job";
			return $this->destroyGeneric($genericClass, $id, function ($query) {
				// \Log::info('Logging User generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}
}
