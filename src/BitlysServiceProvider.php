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
        $this->publishes([__DIR__.'/config' => config_path()], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
