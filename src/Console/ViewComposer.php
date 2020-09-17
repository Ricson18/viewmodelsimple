<?php

namespace viewmodelsimple\simple\Console;

use Illuminate\Console\Command;

class ViewComposer extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:composer {composer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a view composer';

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
        $viewComposer=$this->argument('composer');

        if ($viewComposer === '' || is_null($viewComposer) || empty($viewComposer)) {
            return $this->error('Composer Name Invalid..!');
        }

$contents=
'<?php
namespace App\ViewComposers;
    
use Illuminate\View\View;
        
class '.$viewComposer.'
{
        
    /**
    * Create a new '.$viewComposer.' composer.
    *
    * @return void
    */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
                
    }
        
    /**
    * Bind data to the view.
    *
    * @param  View  $view
    * @return void
    */
    public function compose(View $view)
    {
        //Bind data to view
    }
    
}';
    if ($this->confirm('Do you wish to create '.$viewComposer.' Composer file?')) {
        $file = "${viewComposer}.php";
        $path=app_path();
        
        $file=$path."/ViewComposers/$file";

        if(file_exists("$path/ViewComposers")){
            if(file_exists($file)){
                return $this->error($viewComposer.' File Already exists!');
            }
            if(!file_put_contents($file, $contents)) 
                return $this->error('Something went wrong!');
            $this->info("$viewComposer generated!");
        }
        else{
            mkdir("$path/ViewComposers");

            if(!file_put_contents($file, $contents)) 
                return $this->error('Something went wrong!');
            $this->info("$viewComposer generated!");
        }

    }
    }
}
