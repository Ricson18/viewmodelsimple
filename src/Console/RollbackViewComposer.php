<?php

namespace viewmodelsimple\Console;

use Illuminate\Console\Command;

class RollbackViewComposer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all generated Composer files';

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
     * @return int
     */
    public function handle()
    {
        $file=app_path()."/ViewComposers/*";
        $composerDir=app_path()."/ViewComposers";
        
        if ($this->confirm('Are you sure you want to delete all Composer files?')) {
            // $files = glob('path/to/temp/*'); // get all file names
            $files = glob($file); // get all file names
            if($files){
                foreach($files as $file) // iterate files
                    if(is_file($file))  unlink($file); // delete file
                $this->info("All Composer files deleted!");
                rmdir($composerDir);
            }
            else{ 
                if(file_exists($composerDir)) rmdir($composerDir);
                $this->error('No Composer file(s) in the directory');
            }
            
        }
    }
}
