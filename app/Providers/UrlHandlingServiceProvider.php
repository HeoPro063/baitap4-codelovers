<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UrlHandlingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once app_path(). '/Helpers/UrlHandling.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
