<?php

namespace App\UserInterface\Courier\Providers;

use Illuminate\Routing\Router;
use App\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        parent::map($router);

        $router->group(
            [
            'middleware' => 'web'
            ],
            function ($router) {

                $router->group(
                    [
                    'namespace' => 'App\UserInterface\Courier\Controllers',
                    'domain' => config('userinterface.courier_domain')
                    ],
                    function ($router) {
                        include app_path('UserInterface/Courier/routes.php');
                    }
                );
            }
        );
    }
}
