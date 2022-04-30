<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\Auth\AccountRepository;
use App\Repositories\Admin\Auth\InterfaceAuth;

use App\Repositories\User\Auth\UserRepository;
use App\Repositories\User\Auth\InterfaceUser;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(AccountRepository::class, InterfaceAuth::class);        
        $this->app->singleton(UserRepository::class, InterfaceUser::class);        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
