<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AOE\RBAC\UserPermissionInterface;
use App\AOE\RBAC\UserPermission;
class RBACServiceProvider extends ServiceProvider
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
        $this->app->singleton(UserPermissionInterface::class, UserPermission::class);
    }
}
