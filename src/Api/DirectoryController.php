<?php namespace FlexCMS\BasicCMS\Api;

use \Input;
use \Hash;
use \Uuid;
use FlexCMS\BasicCMS\Models\Directory;
use FlexCMS\BasicCMS\Models\DirectoryStaff;
use FlexCMS\BasicCMS\Models\DirectoryBudget;
use FlexCMS\BasicCMS\Models\DirectoryDonor;
use FlexCMS\BasicCMS\Models\DirectoryActivity;
use FlexCMS\BasicCMS\Models\DirectoryCategory;
use FlexCMS\BasicCMS\Models\DirectoryLibrary;
use FlexCMS\BasicCMS\Models\DirectoryUser;
use FlexCMS\BasicCMS\Models\User;
use FlexCMS\BasicCMS\Models\Item;
use \Auth;
use \DateTime;
use \DateInterval;

class DirectoryController extends ApiController {

	public function index(){
		try{
			$directories = [];
			$directories = Directory::with(['logo', 'category', 'photos', 'categories', 'projectType']);
			if (Input::get('active') && Input::get('active') === 1){
				$directories = $directories->where('is_active', '=', 1);
			}
			if (Input::get('category')){
				$directories = $directories->where('category_id', '=', Input::get('category'));
			}
			if (Input::get('q')){
				$directories = $directories->whereRaw("name like ? OR short_description LIKE ? OR description LIKE ?", 
					['%' . Input::get('q') . '%', '%' . Input::get('q') . '%', '%' . Input::get('q') . '%'])
					->orWhereRaw("id IN (SELECT dc.directory_id FROM items i INNER JOIN directory_categories dc ON i.id = dc.category_id WHERE item_type = 'category' AND display_name LIKE ?)", ['%' . Input::get('q') . '%']);
			}
			$total = count($directories->get()->toArray());

			if (Input::get('ignore-offset') != 1){
				$directories = $directories->take(Input::get('limit') ? Input::get('limit') : 20);
				$directories = $directories->skip(Input::get('offset') ? Input::get('offset') : 0);
			}

			if (Input::get('sort') && Input::get('sort') == 'asc') {
				$directories = $directories->orderBy('name', 'ASC');
			}
			else if (Input::get('sort') && Input::get('sort') == 'desc') {
				$directories = $directories->orderBy('name', 'DESC');
			}

			$directories = $directories->get()->toArray();
			if (Input::get('ignore-offset') != 1){
				return $this->ok($directories, ['count' => $total, 'limit' => Input::get('limit') ? Input::get('limit') : 20, 'offset' => Input::get('offset') ? Input::get('offset') : 0]);
			}
			else{
				return $this->ok($directories, ['count' => $total]);
			}
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function indexByCategory (){
		try{
			$categories = Item::with(['directories' => function ($query) {
				    $query->where('is_active', '=', 1);
				}, 'directories.logo', 'directories.photos', 'directories.categories'])
				->where('item_type', '=', 'category')
				->whereRaw("parent_id IN (SELECT id FROM items WHERE name LIKE 'enterprise-category')")
				->get()
				->toArray();
			
			return $this->ok($categories);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function show($id){
		try{
			if (is_numeric($id)){

				$directory = Directory::with(['logo', 'category', 'photos', 'categories', 'projectType'])->where('id', '=', $id)->get()->first();
			}
			else{
				$directory = Directory::with(['logo', 'category', 'photos', 'categories', 'projectType'])->where('hash', '=', $id)->get()->first();	
			}
			
			return $this->ok($directory);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function store(){
		try{
			$data = Input::all();
			$validation = \Validator::make($data, [
	            'name' => 'required|max:255',
	            // 'hash' => 'required',
	            // 'category_id' => 'required|exists:items,id',
	            // 'description' => 'required',
	            'phones' => 'required',
	            'websites' => 'required',
	            'emails' => 'required',
	            'address' => 'required',
				// 'category_id' => 'required'
	            // 'category_ids' => 'required|array'
	        ]);
	        if ($validation->passes()){
				$category_ids = false;
				if (isset($data['category_ids'])){
					$category_ids = $data['category_ids'];
					unset($data['category_ids']);
				}
				
	        	$data['hash'] = time() . '-' . rand();
	        	
	        	$data['created_by'] = Auth::user()->id;
	        	$data['updated_by'] = Auth::user()->id;
	        	$directory = Directory::create($data);
				if ($category_ids != false){
	        		$directory->categories()->sync($category_ids);
				}
	        	return $this->ok($directory);
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
			$directory = Directory::find($id);
			if (!$directory){
				throw new \Exception('The item cannot be found to update');
			}
			if (Input::get('title')){
				$directory->title = Input::get('title');
			}
			if (Input::get('description')){
				$directory->description = Input::get('description');
			}
			if (Input::get('short_description')){
				$directory->short_description = Input::get('short_description');
			}
			if (Input::get('category_id')){
				$directory->category_id = Input::get('category_id');
			}
			if (Input::get('logo_id') !== null){
				$directory->logo_id = Input::get('logo_id');
			}
			if (Input::get('latitude')){
				$directory->latitude = Input::get('latitude');
			}
			if (Input::get('longitude')){
				$directory->longitude = Input::get('longitude');
			}
			if (Input::get('phones')){
				$directory->phones = Input::get('phones');
			}
			if (Input::get('websites')){
				$directory->websites = Input::get('websites');
			}
			if (Input::get('address')){
				$directory->address = Input::get('address');
			}
			if (Input::get('emails')){
				$directory->emails = Input::get('emails');
			}
			if (Input::get('directory_category_opt')){
				$directory->directory_category_opt = Input::get('directory_category_opt');
			}
			if (Input::get('is_active')){
				$directory->is_active = Input::get('is_active');
			}
			if (Input::get('social_issues')){
				$directory->social_issues = Input::get('social_issues');
			}
			if (Input::get('main_activities')){
				$directory->main_activities = Input::get('main_activities');
			}
			if (Input::get('impact')){
				$directory->impact = Input::get('impact');
			}
			if (Input::get('solutions')){
				$directory->solutions = Input::get('solutions');
			}
			if (Input::get('category_ids') && is_array(Input::get('category_ids'))){
				$directory->categories()->sync(Input::get('category_ids'));
			}
			if (Input::get('appreviation')){
				$directory->appreviation = Input::get('appreviation');
			}
			if (Input::get('background')){
				$directory->background = Input::get('background');
			}
			if (Input::get('vision')){
				$directory->vision = Input::get('vision');
			}
			if (Input::get('mission')){
				$directory->mission = Input::get('mission');
			}
			if (Input::get('goal')){
				$directory->goal = Input::get('goal');
			}
			if (\Input::get('project_type_id') !== null){
				$directory->project_type_id = \Input::get('project_type_id');
			}
			if (\Input::get('faxes')){
				$directory->faxes = Input::get('faxes');
			}
			if (\Input::get('location_id')){
				$directory->location_id = Input::get('location_id');
			}
			if (\Input::get('org_lead_by') != null){
				$directory->org_lead_by = Input::get('org_lead_by');
			}
			$directory->updated_by = Auth::user()->id;
			$directory->save();
			return $this->show($directory->id);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroy($id){
		try{

			$directory = Directory::find($id);

			if (!$directory){
				throw new \Exception('The item cannot be found to delete');
			}	

			// Check permission
			/*
			if (no-permission){
				throw new \Exception('You do not have permission to access this transaction');
			}
			*/

			$directory = $directory->delete();
			return $this->ok(['id' => $id]);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	// GLOBAL FUNCTION 

	public function showGeneric($Model, $directoryId, $id, $closure = null){
		try{
			
			$directory = $this->getCheckDirectory($directoryId);
			$item = $Model::where('id', '=', $id)->where('directory_id', '=', $directoryId);

			if ($closure){
				$closure($item);
			}
			
			$item =$item->get()->first();
			return $this->ok($item);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeGeneric($Model, $directoryId, $closure = null){
		try{
			$directory = $this->getCheckDirectory($directoryId);
			$data = Input::all();
			$item = null;
			$data['directory_id'] = $directoryId;
			if ($closure){
				$data = $closure($data);
			}
			
			$item = $Model::create($data);
			return $this->showGeneric($Model, $directoryId, $item->id);
			// $validation = \Validator::make($data, [
	        //     'name' => 'required|max:255',
	        //     'hash' => 'required',
	        //     // 'category_id' => 'required|exists:items,id',
	        //     'description' => 'required',
	        //     'phones' => 'required',
	        //     'websites' => 'required',
	        //     'emails' => 'required',
	        //     'address' => 'required',
	        //     'category_ids' => 'required|array'
	        // ]);
	        // if ($validation->passes()){
	        // 	$category_ids = $data['category_ids'];
	        // 	unset($data['category_ids']);
	        // 	$data['created_by'] = Auth::user()->id;
	        // 	$data['updated_by'] = Auth::user()->id;
	        // 	$directory = Directory::create($data);
	        // 	$directory->categories()->sync($category_ids);
	        // 	return $this->ok($directory);
	        // }
	        // else{
	        // 	return $this->error($validation->messages(), 'validation-error');
	        // }
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateGeneric($Model, $directoryId, $id, $closure = null){
		try{
			$directory = $this->getCheckDirectory($directoryId);
			$item = $Model::where('id', '=', $id)->where('directory_id', '=', $directoryId)->first();
			if (!$item){
				throw new \Exception('The item cannot be found to update');
			}
			if ($closure){
				$closure($item);
			}
	        $item->updated_by = Auth::user()->id;
			$item->save();
			return $this->showGeneric($Model, $directoryId, $item->id);
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyGeneric($Model, $directoryId, $id){
		try{

			$directory = $this->getCheckDirectory($directoryId);

			$item = $Model::where('id', '=', $id)->where('directory_id', '=', $directoryId);

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

	public function indexGeneric($Model, $directoryId, $closure = null){
		try{

			if ($directoryId){
				$directory = $this->getCheckDirectory($directoryId);
			}
			

			$listing = [];

			if ($directoryId){
				$listing = $Model::where('directory_id', '=', $directoryId);
			}
			else{
				$listing = $Model::whereRaw('1 = 1');
			}
			

			if ($closure){
				$listing = $closure($listing);
			}

			// if (Input::get('q')){
			// 	$directories = $directories->whereRaw("name like ? OR short_description LIKE ? OR description LIKE ?", 
			// 		['%' . Input::get('q') . '%', '%' . Input::get('q') . '%', '%' . Input::get('q') . '%'])
			// 		->orWhereRaw("id IN (SELECT dc.directory_id FROM items i INNER JOIN directory_categories dc ON i.id = dc.category_id WHERE item_type = 'category' AND display_name LIKE ?)", ['%' . Input::get('q') . '%']);
			// }
			$total = count($listing->get()->toArray());

			if (Input::get('ignore-offset') != 1){
				$listing = $listing->take(Input::get('limit') ? Input::get('limit') : 20);
				$listing = $listing->skip(Input::get('offset') ? Input::get('offset') : 0);
			}

			if (Input::get('sort_field') && Input::get('sort') && (Input::get('sort') == 'asc') || Input::get('sort') == 'desc') {
				$listing = $directorilistinges->orderBy(Input::get('sort_field'), Input::get('sort'));
			}

			$listing = $listing->get()->toArray();
			if (Input::get('ignore-offset') != 1){
				return $this->ok($listing, ['count' => $total, 'limit' => Input::get('limit') ? Input::get('limit') : 20, 'offset' => Input::get('offset') ? Input::get('offset') : 0]);
			}
			else{
				return $this->ok($listing, ['count' => $total]);
			}
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	private function getCheckDirectory($id){
		$directory = Directory::find($id);

		if (!$directory){
			throw new \Exception('The item cannot be found to delete');
		}	
		return $directory;
	}

	// DONOR
	// Directory donor 

	public function indexDonor($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryDonor";
			return $this->indexGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging donor generic');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showDonor($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryDonor";
			return $this->showGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging donor generic show');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeDonor($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryDonor";
			return $this->storeGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging donor generic store');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateDonor($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryDonor";
			return $this->updateGeneric($directoryClass, $directory, $id, function ($item) {
				\Log::info('Logging donor generic update');
				if (\Input::get('name') != null){
					$item->name = \Input::get('name');
				}
				if (\Input::get('year') != null){
					$item->year = \Input::get('year');
				}
				if (\Input::get('description') != null){
					$item->description = \Input::get('description');
				}
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyDonor($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryDonor";
			return $this->destroyGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging donor generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	// BUDGET
	// Directory donor 

	public function indexBudget($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryBudget";
			return $this->indexGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging donor generic');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showBudget($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryBudget";
			return $this->showGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging Budget generic show');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeBudget($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryBudget";
			return $this->storeGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging Budget generic store');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateBudget($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryBudget";
			return $this->updateGeneric($directoryClass, $directory, $id, function ($item) {
				if (\Input::get('org_budget') != null){
					$item->org_budget = \Input::get('org_budget');
				}
				if (\Input::get('year') != null){
					$item->year = \Input::get('year');
				}
				if (\Input::get('project_cost') != null){
					$item->project_cost = \Input::get('project_cost');
				}
				if (\Input::get('admin_cost') != null){
					$item->admin_cost = \Input::get('admin_cost');
				}
				if (\Input::get('other_cost') != null){
					$item->other_cost = \Input::get('other_cost');
				}
				if (\Input::get('edu_project_cost') != null){
					$item->edu_project_cost = \Input::get('edu_project_cost');
				}
				if (\Input::get('seq_no') != null){
					$item->seq_no = \Input::get('seq_no');
				}
				\Log::info('Logging Budget generic update');
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyBudget($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryBudget";
			return $this->destroyGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging budget generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	// ACTIVITY
	// Directory donor 

	public function indexActivity($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryActivity";
			return $this->indexGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging donor generic');
				$query = $query->with('locationObj');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showActivity($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryActivity";
			return $this->showGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging Activity generic show');
				$query = $query->with('locationObj');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeActivity($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryActivity";
			return $this->storeGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging Activity generic store');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateActivity($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryActivity";
			return $this->updateGeneric($directoryClass, $directory, $id, function ($item) {
				\Log::info('Logging Activity generic update');
				if (\Input::get('name') != null){
					$item->name = \Input::get('name');
				}
				if (\Input::get('activity_date') != null){
					$item->activity_date = \Input::get('activity_date');
				}
				if (\Input::get('location') != null){
					$item->location = \Input::get('location');
				}
				if (\Input::get('location_id') != null){
					$item->location_id = \Input::get('location_id');
				}
				if (\Input::get('description') != null){
					$item->description = \Input::get('description');
				}
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyActivity($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryActivity";
			return $this->destroyGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging activity generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	// STAFF
	// Directory donor 

	public function indexStaff($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryStaff";
			return $this->indexGeneric($directoryClass, $directory, function ($query) {
				$query = $query->with('type');
				\Log::info('Logging donor generic');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showStaff($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryStaff";
			return $this->showGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging Staff generic show');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeStaff($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryStaff";
			
			return $this->storeGeneric($directoryClass, $directory, function ($data) {
				\Log::info('Logging Staff generic store');
				return $data;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateStaff($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryStaff";
			return $this->updateGeneric($directoryClass, $directory, $id, function ($item) {
				if (\Input::get('gender') != null){
					$item->gender = \Input::get('gender');
				}
				if (\Input::get('type_id') != null){
					$item->type_id = \Input::get('type_id');
				}
				if (\Input::get('name') != null){
					$item->name = \Input::get('name');
				}
				if (\Input::get('description') != null){
					$item->description = \Input::get('description');
				}
				if (\Input::get('quantity') != null){
					$item->quantity = \Input::get('quantity');
				}
				if (\Input::get('female_quantity') != null){
					$item->female_quantity = \Input::get('female_quantity');
				}
				
				\Log::info('Logging Staff generic update');
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyStaff($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryStaff";
			return $this->destroyGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging staff generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	// CONTACT
	// Directory donor 

	public function indexContact($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryContact";
			return $this->indexGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging donor generic');
				$query = $query->with('position');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showContact($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryContact";
			return $this->showGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging Contact generic show');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeContact($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryContact";
			return $this->storeGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging Contact generic store');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateContact($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryContact";
			return $this->updateGeneric($directoryClass, $directory, $id, function ($item) {
				\Log::info('Logging Contact generic update');
				if (\Input::get('name') != null){
					$item->name = \Input::get('name');
				}
				if (\Input::get('position_id') != null){
					$item->position_id = \Input::get('position_id');
				}
				if (\Input::get('email') != null){
					$item->email = \Input::get('email');
				}
				if (\Input::get('phone') != null){
					$item->phone = \Input::get('phone');
				}
				if (\Input::get('social_network') != null){
					$item->social_network = \Input::get('social_network');
				}
				if (\Input::get('seq_no') != null){
					$item->seq_no = \Input::get('seq_no');
				}
				if (\Input::get('contact_type') != null){
					$item->contact_type = \Input::get('contact_type');
				}
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyContract($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryContract";
			return $this->destroyGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging contract generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	// LIBRARY
	// Directory donor 

	public function indexLibrary($directory = null){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryLibrary";
			return $this->indexGeneric($directoryClass, $directory, function ($query) {
				$query = $query->with('documentEnglish')->with('documentKhmer');
				if (\Input::get('scope') == 'detail'){
					$query = $query->with('directory')->with('type');
				}
				if (\Input::get('q')){
					$query = $query->whereRaw("name like ? OR description LIKE ?", 
						['%' . Input::get('q') . '%', '%' . Input::get('q') . '%']);
				}
				\Log::info('Logging donor generic');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showLibrary($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryLibrary";
			return $this->showGeneric($directoryClass, $id, function ($query) {
				$query = $query->with('documentEnglish')->with('documentKhmer');
				\Log::info('Logging Library generic show');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeLibrary($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryLibrary";
			return $this->storeGeneric($directoryClass, $directory, function ($query) {
				\Log::info('Logging Library generic store');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateLibrary($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryLibrary";
			return $this->updateGeneric($directoryClass, $directory, $id, function ($item) {
				\Log::info('Logging Library generic update');
				if (\Input::get('name') != null){
					$item->name = \Input::get('name');
				}
				if (\Input::get('type_id') != null){
					$item->type_id = \Input::get('type_id');
				}
				if (\Input::get('description') != null){
					$item->description = \Input::get('description');
				}
				if (\Input::get('document_english_id') != null){
					$item->document_english_id = \Input::get('document_english_id');
				}
				if (\Input::get('document_khmer_id') != null){
					$item->document_khmer_id = \Input::get('document_khmer_id');
				}
				if (\Input::get('document_english_download') != null){
					$item->document_english_download = \Input::get('document_english_download');
				}
				if (\Input::get('document_khmer_download') != null){
					$item->document_khmer_download = \Input::get('document_khmer_download');
				}
				if (\Input::get('description') != null){
					$item->description = \Input::get('description');
				}
				if (\Input::get('seq_no') != null){
					$item->seq_no = \Input::get('seq_no');
				}
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyLibrary($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryLibrary";
			return $this->destroyGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging library generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}
	// USER
	// Directory donor 

	public function indexUser($directory){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryUser";
			return $this->indexGeneric($directoryClass, $directory, function ($query) {
				$query = $query->with('role');
				\Log::info('Logging donor generic');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function showUser($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryUser";
			return $this->showGeneric($directoryClass, $id, function ($query) {
				$query = $query->with('role');
				\Log::info('Logging User generic show');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function storeUser($directory){
		try{
			$data = Input::all();
			$validation = \Validator::make($data, [
	            'name' => 'required|max:255',
	            'email' => 'required|max:255|unique:users',
	            'password' => 'required'
	        ]);
	        if ($validation->passes()){
                
	        }
	        else{
	        	return $this->error($validation->messages(), 'validation-error');
	        }
			
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryUser";
			return $this->storeGeneric($directoryClass, $directory, function ($item) use ($data){
				\Log::info('Logging User generic store');
	        	$user = User::create([
					'name' => $data['name'],
					'email' => $data['email'],
					'role' => 'member',
					'password' => \Hash::make($data['password']),
					// 'role_id' => isset($data['role_id']) ? $data['role_id'] : ''
				]);
	        	$item['user_id'] = $user->id;

				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function updateUser($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryUser";
			return $this->updateGeneric($directoryClass, $directory, $id, function ($item) {
				\Log::info('Logging User generic update');
				if (\Input::get('name') != null){
					$item->name = \Input::get('name');
				}
				if (\Input::get('role_id') != null){
					$item->role_id = \Input::get('role_id');
				}
				$user = User::find($item->user_id);
				if (!$user){
					throw new \Exception('The user cannot be found to update');
				}
				if (Input::get('name')){
					$user->name = Input::get('name');
				}

				if (Input::get('email')){
					$existing = User::where('email', '=', Input::get('email'))
						->where('id', '!=', $user->id)->get()->toArray();
					if (count($existing) > 0){
						throw new \Exception('Email is already taken');
					}
					$user->email = Input::get('email');
				}	

				if (\Input::get('password') != null){
					$user->password = \Hash::make(\Input::get('password'));
				}
				// $user->updated_by = Auth::user()->id;
				$user->save();
				return $item;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	public function destroyUser($directory, $id){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryUser";
			return $this->destroyGeneric($directoryClass, $directory, $id, function ($query) {
				\Log::info('Logging User generic update');
				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}

	// Directory download 

	public function indexDownload(){
		try{
			$directoryClass = "\\FlexCMS\\BasicCMS\\Models\\DirectoryDownload";
			return $this->indexGeneric($directoryClass, null, function ($query) {
				$query = $query->with('directory')->with('document')->with('directoryLibrary');
				
				if (\Input::get('q')){
					$query = $query->whereRaw("directory_library_id IN (SELECT id FROM directory_libraries i WHERE i.name LIKE ? OR i.description LIKE ?)", ['%' . Input::get('q') . '%', '%' . Input::get('q') . '%']);
						// "name like ? OR email LIKE ? OR role LIKE ?", 
						// ['%' . Input::get('q') . '%', '%' . Input::get('q') . '%', '%' . Input::get('q') . '%']);
				}

				return $query;
			});
		}
		catch(\Exception $e){
			return $this->error($e->getMessage());
		}
	}
}
