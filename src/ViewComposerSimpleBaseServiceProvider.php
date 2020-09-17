<?php

namespace viewmodelsimple;

use Illuminate\Support\ServiceProvider;

class ViewComposerSimpleBaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Console\ViewComposer::class,
            Console\RollbackViewComposer::class,
        ]);
    }
    public function boot(){

    }
    
}
