<?php

namespace FlexCMS\BasicCMS\Commands;

use Illuminate\Console\Command;

class RemovePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flex:remove-page {module} {submodule} {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a file structure for page';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $module = $this->argument('module');

        if (!in_array($module, ['login', 'dashboard', 'browse-media', 'general']) ){
        	// throw new \Exception('Invalid main module name. Should be login or dashboard or browse-media');
        	return $this->error('Invalid main module name. Should be login or dashboard or browse-media');
        }

        $submodule = $this->argument('submodule');

        $action = $this->argument('action');

        // Check path views
        if (file_exists(base_path('resources/views/vendor/flexcms'))){
            $modulePath = base_path('resources/views/vendor/flexcms') . '/' . 'pages/' . $module . '/' . $submodule . '/'; //
        }
        else{
            $modulePath = __DIR__ . '/../resources/views/pages/' . $module . '/' . $submodule . '/'; //
        }
        
        $filePath = $modulePath . $action . '.blade.php';

        $this->info('Removing blade file at: ' . $filePath);

        $cannotRemove = false;

        if (file_exists($modulePath)){
            // Do remove it
        	 unlink($filePath);
        }
        else{
            // Cannot
            $cannotRemove = true;
        }

        // JAVASCRIPT
        $jsCtrlName = ucfirst($module) . ucfirst($submodule) . ucfirst($action) . 'Ctrl';

        // Form js file path
        // $moduleJSPath = __DIR__ . '/../public/flexcms/js/controllers/' . $module . '/' . $submodule . '/'; //
        if (public_path('vendor/flexcms')){
            $moduleJSPath = public_path('vendor/flexcms') . '/js/controllers/' . $module . '/' . $submodule . '/'; //
        }
        else{
            $moduleJSPath = __DIR__ . '/../public/flexcms/js/controllers/' . $module . '/' . $submodule . '/'; //
        }
        $fileJSPath = $moduleJSPath . $action . '.js';

        if (file_exists($moduleJSPath)){
            unlink($fileJSPath);
            $cannotRemove = false;
        }
        else{
            $cannotRemove = true;
        }

    
        // Add to module js load routes
        if (file_exists(config_path('flexmodules.php'))){
            $configFilePath = config_path('flexmodules.php');
        }
        else{
            $configFilePath = __DIR__ . '/../config/flexmodules.php';
        }
        $configModule = \File::getRequire($configFilePath);

        if (!isset($configModule['modules'][$module][$submodule])){
        	// $configModule['modules'][$module][$submodule] = [$action];        	
        }
        else{
        	if (in_array($action, $configModule['modules'][$module][$submodule])){
                $index = array_search($action, $configModule['modules'][$module][$submodule]);
				unset($configModule['modules'][$module][$submodule][$index]);        	
			}
        }

        file_put_contents($configFilePath, '<?php return '.var_export($configModule, true).';' , LOCK_EX);

        // file_put_contents(base_path().'/app/lang/en/test.php', '<?php return '.var_export($en,true).';' , LOCK_EX);

        if ($cannotRemove){
            $this->error('Page cannot be removed.');
        }
        else{
            $this->info('Page removed successfully.');
        }
        
    }
}
