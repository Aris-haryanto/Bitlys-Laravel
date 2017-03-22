<?php

namespace Arisharyanto\Bitlys;

use Illuminate\Support\ServiceProvider;

class BitlysServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Arisharyanto\Bitlys\BitlysController');
    }
}
