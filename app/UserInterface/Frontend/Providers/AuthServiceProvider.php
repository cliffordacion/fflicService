<?php

namespace App\UserInterface\Frontend\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\Providers\AuthServiceProvider as ServiceProvider;

use App\UserInterface\Frontend\Policies\FrontendPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }
}
