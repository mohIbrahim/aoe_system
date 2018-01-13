<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AOE\Repositories\PrintingMachine\PrintingMachineInterface;
use App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;
use App\AOE\Repositories\Customer\EloquentCustomer;
use App\AOE\Repositories\Customer\CustomerInterface;
use App\AOE\Repositories\ReadingOfPrintingMachine\EloquentReadingOfPrintingMachine;
use App\AOE\Repositories\ReadingOfPrintingMachine\ReadingOfPrintingMachineInterface;
use App\AOE\Repositories\Department\EloquentDepartment;
use App\AOE\Repositories\Department\DepartmentInterface;
use App\AOE\Repositories\Part\EloquentPart;
use App\AOE\Repositories\Part\PartInterface;
use App\AOE\Repositories\PartSerialNumber\EloquentPartSerialNumber;
use App\AOE\Repositories\PartSerialNumber\PartSerialNumberInterface;
use App\AOE\Repositories\InstallationRecord\EloquentInstallationRecord;
use App\AOE\Repositories\InstallationRecord\InstallationRecordInterface;

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
        $this->app->singleton(ReadingOfPrintingMachineInterface::class, EloquentReadingOfPrintingMachine::class);
        $this->app->singleton(DepartmentInterface::class, EloquentDepartment::class);
        $this->app->singleton(PartInterface::class, EloquentPart::class);
        $this->app->singleton(PartSerialNumberInterface::class, EloquentPartSerialNumber::class);
        $this->app->singleton(InstallationRecordInterface::class, EloquentInstallationRecord::class);
    }
}
