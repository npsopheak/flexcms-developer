<?php

namespace FlexCMS\BasicCMS\Commands;

use Illuminate\Console\Command;
use \RecursiveDirectoryIterator;

class ClearResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flex:clear-resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear resource folder';

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
        
        $publicPath = public_path('../resources/views/vendor/flexcms');
        try{

            $it = new \RecursiveDirectoryIterator($publicPath, \RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new \RecursiveIteratorIterator($it,
                        \RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($publicPath);
        }
        catch (\Exception $e){

        }
		$this->info('Resource folder has been cleared.');
    }
}
