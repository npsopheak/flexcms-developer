<?php

namespace FlexCMS\BasicCMS\Commands;

use Illuminate\Console\Command;

class AddScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flex:add-script {type} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate script service or directive structure for page';

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
        
        $type = $this->argument('type');

        if (!in_array($type, ['services', 'directives', 'controllers', 'util']) ){
        	// throw new \Exception('Invalid main module name. Should be login or dashboard or browse-media');
        	return $this->error('Invalid script type. Should be services or directives');
        }

        $name = $this->argument('name');

        // JAVASCRIPT
        $jsCtrlName = ucfirst($name);

        // Form js file path
        $moduleJSPath = __DIR__ . '/../public/flexcms/js/' . $type . '/';
        $fileJSPath = $moduleJSPath . $name . '.js';

        if (!file_exists($moduleJSPath)){
        	 mkdir($moduleJSPath, 0775, true);
        }

        if ($type == 'util'){
            file_put_contents($fileJSPath, '');
        }
        else{
            // Load sample content
            $sampleFilePath = __DIR__ . '/../resources/samples/' . $type . '.js'; 
            $content = file_get_contents($sampleFilePath);

            // Prefix 
            $prefx = [
                'services' => 'Service',
                'controllers' => 'Ctrl',
                'directives' => '',
                'util' => '',
            ];

            // Put content
            file_put_contents($fileJSPath, str_replace('{NAME}', $jsCtrlName . $prefx[$type], $content));
        }

        // Add to module js load routes
        $configFilePath = __DIR__ . '/../config/flexmodules.php';
        $configModule = \File::getRequire($configFilePath);

        if (!isset($configModule['customs'])){
        	$configModule['customs'] = [$type . '/' . $name];        	
        }
        else{
        	if (!in_array($name, $configModule['customs'])){
				$configModule['customs'][] = $type . '/' . $name;        	
			}
        }

        file_put_contents($configFilePath, '<?php return '.var_export($configModule, true).';' , LOCK_EX);

        // file_put_contents(base_path().'/app/lang/en/test.php', '<?php return '.var_export($en,true).';' , LOCK_EX);

        $this->info('Script Added Successfully.');

        // echo $jsCtrlName;

        // Generating Controller name

        // Create file php views 

        // Create js controllers 
    }
}
