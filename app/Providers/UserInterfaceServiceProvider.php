<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserInterfaceServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register Providers for each UserInterface
     *
     * @return void
     */
    public function boot()
    {
        if (file_exists(app_path('UserInterface/Backend'))) {
            \App::register('App\UserInterface\Backend\Providers\RouteServiceProvider');
            \App::register('App\UserInterface\Backend\Providers\AuthServiceProvider');
        }
        if (file_exists(app_path('UserInterface/Frontend'))) {
            \App::register('App\UserInterface\Frontend\Providers\RouteServiceProvider');
            \App::register('App\UserInterface\Frontend\Providers\AuthServiceProvider');
        }
        if (file_exists(app_path('UserInterface/Courier'))) {
            \App::register('App\UserInterface\Courier\Providers\RouteServiceProvider');
            \App::register('App\UserInterface\Courier\Providers\AuthServiceProvider');
        }
    }
}
