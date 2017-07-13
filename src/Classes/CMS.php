<?php

namespace FlexCMS\BasicCMS\Classes;

class CMS {

    public function getTheme()
    {
        return env('THEME', 'default');
    }

    // php artisan vendor:publish --tag=public 
    public function generateScripts($main, $scripts = []){
        $modules = config('flexmodules.modules');
        $ignoreModules = config('flexcms.cms.modules.excepts');

        $base = 'vendor/flexcms/js';

        $files = [];

        if ($main == 'customs'){
            $globals = config('flexmodules.customs');;

            foreach($globals as $key => $value){
                if (in_array($value, $scripts) || count($scripts) == 0){
                    // Ignore custom in flexcms configuration
                    if (in_array($value, $ignoreModules) != 1){
                        $files[] = $base . '/' . $value . '.js';
                    }
                
                }
                else{

                }
                
            }
        }
        else{

            if ($main != 'general'){

                if ($main == 'global'){

                    $globals = $modules['global'];

                    foreach($globals as $key => $value){
                        if (strpos($value, 'services/') !== 0 && strpos($value, 'directives/') !== 0){
                            $files[] = $base . '/' . $value . '.js';
                        }
                        else{

                        }
                        
                    }
                    // return;
                }
                else {

                    $files[] = $base . '/apps/' . $main . '.js';    
                    $files[] = $base . '/apps/' . $main . '.config.js';    
                    // TODO: Next handle directive correctly
                    // $globals = $modules['global'];

                    // foreach($globals as $key => $value){
                    //     if (strpos($value, 'services/') == 0 || strpos($value, 'directives/') == 0){
                    //         $files[] = $base . '/' . $value . '.js';
                    //     }
                    //     else{
                            
                    //     }
                        
                    // } 
                }
            }

            if ($main != 'global'){
                
                $mains = $modules[$main];

                foreach($mains as $key => $value){
                    if (is_array($value)){
                        foreach($value as $k => $v){
                            // Ignore module dashboard in flexcms configuration
                            if (in_array($main . '/' . $key, $ignoreModules) != 1){
                                $files[] = $base . '/controllers/' . $main . '/' . $key . '/' . $v . '.js';    
                            }
                            
                        }
                        
                    }
                    else if (is_string($value)){ 
                        // Ignore module dashboard in flexcms configuration
                        if (in_array($main . '/' . $key, $ignoreModules) != 1){
                            $files[] = $base . '/controllers/' . $main . '/' . $key . '/' . $value . '.js';
                        }
                    }
                    
                }   
            }
        }


        $strings = [];
        foreach ($files as $key => $value) {
            // <script type="text/javascript" src="{{ asset('vendor/flexcms/js/app.login.js') }}"></script>
            $strings[] = '<script  type="text/javascript" src="' . asset($value) . '"></script>';
        }

        return implode('', $strings);
        
    }

    public function extractInfo($content){
        $delimiter = '#';
        $startTag = '{INFO}';
        $endTag = '{/INFO}';
        $regex = $delimiter . preg_quote($startTag, $delimiter) 
                            . '(.*?)' 
                            . preg_quote($endTag, $delimiter) 
                            . $delimiter 
                            . 's';
        $matches = [];
        preg_match($regex,$content,$matches);
        return $matches;
    }

    public function replaceInfo($content, $replacement){
        $delimiter = '#';
        $startTag = '{INFO}';
        $endTag = '{/INFO}';
        $regex = $delimiter . preg_quote($startTag, $delimiter) 
                            . '(.*?)' 
                            . preg_quote($endTag, $delimiter) 
                            . $delimiter 
                            . 's';
        $matches = [];
        return preg_replace($regex, '{INFO}' . $replacement . '{/INFO}', $content);
        // return $content;
    }

    /*
     * Retrieve page list from themes directory
     */
    public function getPages(){
        $defaultTheme = env('THEME', 'default');
        $path = app_path() . "/../resources/views/themes/$defaultTheme/";
        $pagePath = $path . "pages";
        $metaFilePath = $path . "$defaultTheme.json";

        try{

            $validator = file_exists($metaFilePath) && is_dir($pagePath);
            if ($validator){
                // Read file list from directory
                $pages = [];
                if ($dh = opendir($pagePath)){
                    while (($file = readdir($dh)) !== false){
                        $filePath = $pagePath . '/' . $file;                    
                        if ($file == '.' || $file == '..') {
                            continue;
                        }
                        $content = file_get_contents($filePath);
                        $info = $this->extractInfo($content);
                        $pages[] = [
                            'name' => $file,
                            'page-name' => substr($file, 0, strpos($file, '.')),
                            'info' => isset($info[1]) ? json_decode($info[1], true) : null
                        ];
                    }
                    closedir($dh);
                }
                return $pages;
            }
            else{
                return [];
            }
        }
        catch (\Exception $e){          
            return [];
        }
    }

    /*
     * Retrieve layouts from current themes layout path
     */
    public function getLayouts(){

        $defaultTheme = env('THEME', 'default');
        $path = app_path() . "/../resources/views/themes/$defaultTheme/";
        $layoutPath = $path . "layouts";
        $metaFilePath = $path . "$defaultTheme.json";
        try{
            $validator = file_exists($metaFilePath) && is_dir($layoutPath);
            if ($validator){

                // Read layouts
                $layouts = [];
                if ($dh = opendir($layoutPath)){
                    while (($file = readdir($dh)) !== false){
                        $filePath = $layoutPath . '/' . $file;                  
                        if ($file == '.' || $file == '..') {
                            continue;
                        }
                        $content = file_get_contents($filePath);
                        $info = $this->extractInfo($content);
                        $layouts[] = [
                            'name' => $file,
                            'info' => isset($info[1]) ? json_decode($info[1], true) : null
                        ];
                    }
                    closedir($dh);
                }
                return $layouts;
            }
            else{
                return [];
            }
        }
        catch (\Exception $e){          
            return [];
        }
    }

    /*
     * Retrieve view name by link url that page is created from dashboard and have predefined link url
     */
    public function getViewNameByLink($link){
        $pages = $this->getPages();
        $current = null;
        foreach ($pages as $key => $page) {
            if ($page['info']['link'] === $link){
                $current = $page;
                break;
            }
        }
        if ($current){
            return $this->view(substr($current['name'], 0, strpos($current['name'], '.')));
        }
        else{
            throw new \Exception('Cannot find view name by link');
        }
    }
    /*
     * Exchange view name for blade view path
     */
    public function view($viewName){
        $defaultTheme = env('THEME', 'default');
        return "themes.$defaultTheme.pages." . $viewName;
    }

    /*
     * Exchange view info
     */
    public function getPageInfo($pageName){
        $defaultTheme = env('THEME', 'default');
        $path = app_path() . "/../resources/views/themes/$defaultTheme/";
        $pagePath = $path . "pages/" . $pageName . '.blade.php';
        if (file_exists($pagePath)){            
            $content = file_get_contents($pagePath);
            $info = $this->extractInfo($content);
            return isset($info[1]) ? json_decode($info[1], true) : null;
        }
        else{
            return null;
        }
    }

    /*
     * Save view info back
     */
    public function setPageInfo($pageName, $info, $layout = []){
        $defaultTheme = env('THEME', 'default');
        $path = app_path() . "/../resources/views/themes/$defaultTheme/";
        $pagePath = $path . "pages/" . $pageName . '.blade.php';
        if (file_exists($pagePath)){            
            $content = file_get_contents($pagePath);

            if (isset($layout['old-layout']) && $layout['old-layout']){
                if (isset($layout['layout']) && $layout['layout']){
                    $content = str_replace($layout['old-layout'], $layout['layout'], $content);
                }
                
            }
            else{
                if (isset($layout['layout']) && $layout['layout']){
                    $content = "@extends('" . $layout['layout'] . "')\n\n" . $content;
                }
            }
            $content = $this->replaceInfo($content, json_encode($info, JSON_PRETTY_PRINT));
            file_put_contents($pagePath, $content);
            return true;
        }
        else{
            return false;
        }
    }

    private function format_uri($string, $separator = '-')
    {
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }

    public function getSlug($name, $id){
        return $id . '-' . $this->format_uri($name);
    }

    public function getSlugId($slug){
        return explode('-', $slug)[0];
    }

    public function getPaths(){

    }

    // Piece title must be unique to get from it
    public function getPiece($title, $default = '', $locale = ''){
        $post = \FlexCMS\BasicCMS\Models\Article::where('title', '=', $title)->first();
        return $post ? $post->description : $default;
    }

    public function getPost($title, $locale = ''){

        $post = \FlexCMS\BasicCMS\Models\Article::where('title', '=', $title)->with('primaryMedia')->with('photos')->first();
        if ($locale == ''){
            return $post;
        }
        else if ($post && $post->id){
            $locale = \FlexCMS\BasicCMS\Models\Article::where('parent_id', '=', $post->id)->with('primaryMedia')->with('photos')->where('language', '=', $locale)->first();
            if (!$locale){
                return $post;
            }
            return $locale;
        }
        else{
            return null;
        }
    }

    public function getPostById($id, $options = []){
        $with = isset($options['with']) && is_array($options['with']) ? $options['with'] : [];
        $locale = isset($options['locale']) ? $options['locale'] : '';
        $post = \FlexCMS\BasicCMS\Models\Article::with($with)->where('id', '=', $id)->first();
        if ($locale == ''){
            return $post->toArray();
        }
        else{
            $locale = \FlexCMS\BasicCMS\Models\Article::with($with)->where('parent_id', '=', $post->id)->where('language', '=', $locale)->first();
            if (!$locale){
                return $post->toArray();
            }
            return $locale->toArray();
        }
    }

    // Get posts by type
    public function postsByType($type, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $limit = isset($options['limit']) && $options['limit'] ? $options['limit'] : null;
        $offset = isset($options['offset']) && $options['offset'] ? $options['offset'] : null;

        $type = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'type')->where('name', '=', $type)->first();
        if ($type){
            $post = \FlexCMS\BasicCMS\Models\Article::with('category')->where('type_id', '=', $type->id);
            if ($order){
                $post = $post->orderByRaw($order);
            }
            if ($limit){
                $post = $post->take($limit);
            }
            if ($offset){
                $post = $post->offset($offset);
            }
            $post = $post->get()->toArray();
            return $post;
        }
        else{
            return [];
        }
    }

    public function postsByTypeId($type, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $limit = isset($options['limit']) && $options['limit'] ? $options['limit'] : null;
        $offset = isset($options['offset']) && $options['offset'] ? $options['offset'] : null;

        $type = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'type')->where('id', '=', $type)->first();
        if ($type){
            $post = \FlexCMS\BasicCMS\Models\Article::with('category')->where('type_id', '=', $type->id);
            if ($order){
                $post = $post->orderByRaw($order);
            }
            if ($limit){
                $post = $post->take($limit);
            }
            if ($offset){
                $post = $post->offset($offset);
            }
            $post = $post->get()->toArray();
            return $post;
        }
        else{
            return [];
        }
    }

    // Get posts by category
    public function postsByCategory($category, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $limit = isset($options['limit']) && $options['limit'] ? $options['limit'] : null;
        $offset = isset($options['offset']) && $options['offset'] ? $options['offset'] : null;
        $lang = isset($options['lang']) && $options['lang'] ? $options['lang'] : 'en';
        
        if (is_numeric($category)){
            $category = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'category')->where('id', '=', $category)->first();
        }
        else{
            $category = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'category')->where('name', '=', $category)->first();    
        }
        
        if ($category){
            $post = \FlexCMS\BasicCMS\Models\Article::with('category')
                ->with('primaryMedia')
                ->with('photos')
                ->where('category_id', '=', $category->id)->whereRaw('language = \'en\'');
            if ($lang == 'en'){
            }
            else{
                $post = \FlexCMS\BasicCMS\Models\Article::whereRaw('(category_id = ? AND language = ? AND (parent_id IS NOT NULL AND parent_id > 0))', [$category->id, $lang]);
            }
            if ($order){
                $post = $post->orderByRaw($order);
            }
            if ($limit){
                $post = $post->take($limit);
            }
            if ($offset){
                $post = $post->offset($offset);
            }
            $post = $post->get()->toArray();
            return $post;
        }
        else{
            return [];
        }
    }

    // Get posts count by category
    public function countPostsByCategory($category, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $lang = isset($options['lang']) && $options['lang'] ? $options['lang'] : 'en';
        
        if (is_numeric($category)){
            $category = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'category')->where('id', '=', $category)->first();
        }
        else{
            $category = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'category')->where('name', '=', $category)->first();    
        }
        
        if ($category){
            $post = \FlexCMS\BasicCMS\Models\Article::with('category')->where('category_id', '=', $category->id)->whereRaw('language = \'en\'');
            if ($lang == 'en'){
            }
            else{
                $post = \FlexCMS\BasicCMS\Models\Article::whereRaw('(category_id = ? AND language = ? AND (parent_id IS NOT NULL AND parent_id > 0))', [$category->id, $lang]);
            }
            if ($order){
                $post = $post->orderByRaw($order);
            }
            $count = $post->get()->count();
            return $count;
        }
        else{
            return [];
        }
    }

    // Get posts by category
    public function itemsByType($type, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $limit = isset($options['limit']) && $options['limit'] ? $options['limit'] : null;
        $offset = isset($options['offset']) && $options['offset'] ? $options['offset'] : null;
        $lang = isset($options['lang']) && $options['lang'] ? $options['lang'] : 'en';
        $with = isset($options['with']) && is_array($options['with']) ? $options['with'] : [];
        
        $type = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'type')
            ->where('name', '=', $type)->first();
        if ($type){
            $items = \FlexCMS\BasicCMS\Models\Item::with($with)->where('parent_id', '=', $type->id);
            if ($order){
                $items = $items->orderByRaw($order);
            }
            if ($limit){
                $items = $items->take($limit);
            }
            if ($offset){
                $items = $items->offset($offset);
            }
            $items = $items->get()->toArray();
            return $items;
        }
        else{
            return [];
        }
    }
        // Get posts by category
    public function itemsByItemType($type, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $limit = isset($options['limit']) && $options['limit'] ? $options['limit'] : null;
        $offset = isset($options['offset']) && $options['offset'] ? $options['offset'] : null;
        $lang = isset($options['lang']) && $options['lang'] ? $options['lang'] : 'en';
        $with = isset($options['with']) && is_array($options['with']) ? $options['with'] : [];
        
        $items = \FlexCMS\BasicCMS\Models\Item::with($with)->where('item_type', '=', $type);
        if ($order){
            $items = $items->orderByRaw($order);
        }
        if ($limit){
            $items = $items->take($limit);
        }
        if ($offset){
            $items = $items->offset($offset);
        }
        $items = $items->get()->toArray();
        return $items;
    }

    // Get posts by category
    public function itemById($id, $options = []){

        $with = isset($options['with']) && is_array($options['with']) ? $options['with'] : [];
        $locale = isset($options['locale']) ? $options['locale'] : '';
        $item = \FlexCMS\BasicCMS\Models\Item::with($with)->where('id', '=', $id)->first()->toArray();
        return $item;
    }


    // Get media by album
    public function mediaByAlbum($album, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $limit = isset($options['limit']) && $options['limit'] ? $options['limit'] : null;
        $offset = isset($options['offset']) && $options['offset'] ? $options['offset'] : null;
        
        $album = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'album')->where('name', '=', $album)->first();
        if ($album){
            $media = \FlexCMS\BasicCMS\Models\Media::with('album')->where('album_id', '=', $album->id);
            if ($order){
                $media = $media->orderByRaw($order);
            }
            if ($limit){
                $media = $media->take($limit);
            }
            if ($offset){
                $media = $media->offset($offset);
            }
            $media = $media->get();
            return $media->toArray();
        }
        else{
            return [];
        }
    }

    // Get media by album
    public function mediaByAlbums($albums, $options = []){
        $order = isset($options['order']) && $options['order'] ? $options['order'] : null;
        $limit = isset($options['limit']) && $options['limit'] ? $options['limit'] : null;
        $offset = isset($options['offset']) && $options['offset'] ? $options['offset'] : null;
        
        $album = \FlexCMS\BasicCMS\Models\Item::where('item_type', '=', 'album');//->where('name', '=', $album)->first();
        // foreach ($albums as $key => $value) {
        //     $album = $album->orWhere('name', '=', $value);
        // }
        $album = $album->whereIn('name', $albums);
        $album = $album->get();
        foreach ($album as $key => $value) {
            $album[$key]->media = \FlexCMS\BasicCMS\Models\Media::where('album_id', '=', $value->id);
            if ($order){
                $album[$key]->media = $album[$key]->media->orderByRaw($order);
            }
            $album[$key]->media = $album[$key]->media->get()->toArray();
        }
        
        return $album->toArray();
    }

    // Helper action 
	public function resourceList($Model, $options = [], $closure = null){
    

        $listing = [];

        $listing = $Model::whereRaw('1 = 1');
        

        if ($closure){
            $listing = $closure($listing);
        }

        $total = count($listing->get()->toArray());

        if (!isset($options['limit'])){
            $options['limit'] = 20;
        }
        if (!isset($options['offset'])){
            $options['offset'] = 0;
        }
        if (isset($options['order'])){
            $listing = $listing->orderBy($options['order'][0], $options['order'][1]);
        }

        if (!isset($options['ignore-offset']) || $options['ignore-offset'] != 1){
            $listing = $listing->take($options['limit']);
            $listing = $listing->skip($options['offset']);
        }

        // if (Input::get('sort_field') && Input::get('sort') && (Input::get('sort') == 'asc') || Input::get('sort') == 'desc') {
        // 	$listing = $listing->orderBy(Input::get('sort_field'), Input::get('sort'));
        // }

        $listing = $listing->get()->toArray();
        if (!isset($options['ignore-offset']) || $options['ignore-offset'] != 1){
            return [
                'result' => $listing, 
                'options' => ['count' => $total, 'limit' => $options['limit'], 'offset' => $options['offset']]
            ];
        }
        else{
            return [
                'result' => $listing, 
                'options' => ['count' => $total]
            ];
            
        }
    }

	public function resourceShow($Model, $id, $closure = null){

        $item = $Model::where('id', '=', $id);

        if ($closure){
            $closure($item);
        }
        
        $item = $item->get()->first()->toArray();
        return $item;
	}

	public function resourceUpdate($Model, $id, $closure = null){
		
        $item = $Model::where('id', '=', $id)->first();
        if (!$item){
            throw new \Exception('The item cannot be found to update');
        }
        if ($closure){
            $item = $closure($item);
        }
        // TODO: Add save user
        // $item->updated_by = Auth::user()->id;
        $item->save();
        return $item;
		
	}

	public function resourceStore($Model, $data = [], $closure = null){
		
        $item = null;
        if ($closure){
            $data = $closure($data);
        }
        
        $item = $Model::create($data);
        return $this->resourceShow($Model, $item->id);
    
	}

    public function generatePagination($total_pages, $limit, $page, $baseUrl){
        // How many adjacent pages should be shown on each side?
        $adjacents = 3;
        if($page) 
            $start = ($page - 1) * $limit; 			//first item to display on this page
        else
            $start = 0;								//if no page var is given, set start to 0
        
        /* Setup page vars for display. */
        if ($page == 0) $page = 1;					//if no page var is given, default to 1.
        $prev = $page - 1;							//previous page is page - 1
        $next = $page + 1;							//next page is page + 1
        $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;						//last page minus 1
        
        /* 
            Now we apply our rules and draw the pagination object. 
            We're actually saving the code to a variable in case we want to draw it more than once.
        */
        $pagination = "";
        if($lastpage > 1)
        {	
            $pagination .= "<ul class=\"pagination pagination-sm\">";
            //previous button
            if ($page > 1) 
                $pagination.= "<li class=\"page-item\">
                    <a href=\"" . $baseUrl . "?page=$prev\" class=\"page-link\" aria-label=\"Previous\">
                        <span aria-hidden=\"true\">&laquo;</span>
                    </a>
                    </li>";
                    // <a href=\"diggstyle.php?page=$prev\">« previous</a>";
            else
                $pagination.= "<li class=\"page-item\">
                    <a href=\"#\" class=\"page-link\" aria-label=\"Previous\">
                        <span aria-hidden=\"true\">&laquo;</span>
                    </a>
                    </li>";	
            
            //pages	
            if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
            {	
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= '<li class="page-item active"><a class="page-link" href="#">' . $counter . '</a></li>';
                        // $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $counter . '">' . $counter . '</a></li>';	
                        // $pagination.= "<a href=\"diggstyle.php?page=$counter\">$counter</a>";					
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
            {
                //close to beginning; only hide later pages
                if($page < 1 + ($adjacents * 2))		
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= '<li class="page-item active"><a class="page-link" href="#">' . $counter . '</a></li>';
                        else
                            $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $counter . '">' . $counter . '</a></li>';			
                    }
                    $pagination.= "...";
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $lastpage . '">' . $lastpage . '</a></li>';
                        //"<a href=\"diggstyle.php?page=$lpm1\">$lpm1</a>";
                    // $pagination.= "<a href=\"diggstyle.php?page=$lastpage\">$lastpage</a>";		
                }
                //in middle; hide some front and some back
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=1">1</a></li>';
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=2">2</a></li>';
                    // $pagination.= "<a href=\"diggstyle.php?page=1\">1</a>";
                    // $pagination.= "<a href=\"diggstyle.php?page=2\">2</a>";
                    $pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= '<li class="page-item active"><a class="page-link" href="#">' . $counter . '</a></li>';
                            // $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $counter . '">' . $counter . '</a></li>';		
                            // $pagination.= "<a href=\"diggstyle.php?page=$counter\">$counter</a>";					
                    }
                    $pagination.= "...";
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $lastpage . '">' . $lastpage . '</a></li>';
                    // $pagination.= "<a href=\"diggstyle.php?page=$lpm1\">$lpm1</a>";
                    // $pagination.= "<a href=\"diggstyle.php?page=$lastpage\">$lastpage</a>";		
                }
                //close to end; only hide early pages
                else
                {
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=1">1</a></li>';
                    $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=2">2</a></li>';
                    // $pagination.= "<a href=\"diggstyle.php?page=1\">1</a>";
                    // $pagination.= "<a href=\"diggstyle.php?page=2\">2</a>";
                    $pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= '<li class="page-item active"><a class="page-link" href="#">' . $counter . '</a></li>';
                        else
                            $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $counter . '">' . $counter . '</a></li>';		
                    }
                }
            }
            
            //next button
            if ($page < $counter - 1) 
                $pagination.= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $next . '"><span aria-hidden="true">&raquo;</span></a></li>';		
                // $pagination.= "<a href=\"diggstyle.php?page=$next\">next »</a>";
            else
                // $pagination.= "<span class=\"disabled\">next »</span>";
                $pagination.= '<li class="page-item"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            $pagination.= "</ul>\n";		
        }
        return $pagination;
    }

    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}