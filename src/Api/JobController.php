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
				if (\Input::get('status') != null){
					\Log::info(\Input::get('status'));
					$query = $query->where('status', '=', \Input::get('status'));
				}
				else{
					$query = $query->whereIn('status', ['active']);
				}
				if (\Input::get('search') != null){
					$query = $query->where('name', 'like', '%' . \Input::get('search') . '%');
				}
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
				if (\Input::get('requirement') != null){
					$item->requirement = \Input::get('requirement');
				}
				if (\Input::get('responsibility') != null){
					$item->responsibility = \Input::get('responsibility');
				}
				if (\Input::get('description') != null){
					$item->description = \Input::get('description');
				}
				if (\Input::get('closing_date') != null){
					$item->closing_date = \Input::get('closing_date');
				}
				if (\Input::get('number_hire') != null){
					$item->number_hire = \Input::get('number_hire');
				}
				if (\Input::get('location') != null){
					$item->location = \Input::get('location');
				}
				if (\Input::get('experience') != null){
					$item->experience = \Input::get('experience');
				}
				if (\Input::get('job_term') != null){
					$item->job_term = \Input::get('job_term');
				}
				if (\Input::get('name') != null){
					$item->name = \Input::get('name');
				}
				if (\Input::get('age_from') != null){
					$item->age_from = \Input::get('age_from');
				}
				if (\Input::get('age_to') != null){
					$item->age_to = \Input::get('age_to');
				}
				if (\Input::get('qualification') != null){
					$item->qualification = \Input::get('qualification');
				}
				if (\Input::get('gender') != null){
					$item->gender = \Input::get('gender');
				}
				if (\Input::get('status') != null){
					$item->status = \Input::get('status');
					JobApplication::where('job_id', '=', $item->id)
						->update(['status' => 'inactive']);
				}
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

	public function indexJobApplication(){
		try{
			$genericClass = "\\FlexCMS\\BasicCMS\\Models\\JobApplication";
			return $this->indexGeneric($genericClass, function ($query) {
				if (\Input::get('status') != null){
					$query = $query->where('status', '=', \Input::get('status'));
				}
				else{
					if (\Input::get('job_id') == null){
						$query = $query->whereIn('status', ['active', 'shortlisted']);
					}
					else{

					}
				}
				if (\Input::get('job_id') != null){
					$query = $query->where('job_id', '=', \Input::get('job_id'));
					$query = $query->whereIn('status', ['inactive', 'active']);
				}
				
				$query = $query->with('job')->with('attachments');
				$query = $query->orderBy('id', 'DESC');
				// \Log::info('Logging donor generic');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateJobApplication($id){
		try{
			$genericClass = "\\FlexCMS\\BasicCMS\\Models\\JobApplication";
			return $this->updateGeneric($genericClass, $id, function ($item) {
				if (\Input::get('status') != null){
					$item->status = \Input::get('status');
				}
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}
}
