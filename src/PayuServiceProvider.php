<?php

namespace Savage\Payu;

use Illuminate\Support\ServiceProvider;

class PayuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       //$this->package('cihan/payu');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->bind('Payu', function($app){
            return new Payu();
        });
    }
	
}
