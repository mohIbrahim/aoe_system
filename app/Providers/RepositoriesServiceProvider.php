<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AOE\Repositories\PrintingMachine\PrintingMachineInterface;
use App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;
use App\AOE\Repositories\Customer\EloquentCustomer;
use App\AOE\Repositories\Customer\CustomerInterface;

class RepositoriesServiceProvider extends ServiceProvider
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
        $this->app->singleton(PrintingMachineInterface::class, EloquentPrintingMachine::class);
		$this->app->singleton(CustomerInterface::class, EloquentCustomer::class);
    }
}
