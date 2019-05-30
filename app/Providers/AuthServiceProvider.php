<?php

namespace App\Providers;

use App\Auth\AdminProvider;
use App\Auth\TenantProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Registra adminProvider
         */
        \Auth::provider('admin_provider', function ($app, array $config) {
            return new AdminProvider($app['hash'], $config['model']);
        });

        /**
         * Registra tenantProvider
         */
        \Auth::provider('tenant_provider', function ($app, array $config) {
            return new TenantProvider($app['hash'], $config['model']);
        });
    }
}
