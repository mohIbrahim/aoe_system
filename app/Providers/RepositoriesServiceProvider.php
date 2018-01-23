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
use App\AOE\Repositories\Contract\EloquentContract;
use App\AOE\Repositories\Contract\ContractInterface;
use App\AOE\Repositories\Invoice\EloquentInvoice;
use App\AOE\Repositories\Invoice\InvoiceInterface;
use App\AOE\Repositories\Visit\EloquentVisit;
use App\AOE\Repositories\Visit\VisitInterface;
use App\AOE\Repositories\FollowUpCard\EloquentFollowUpCard;
use App\AOE\Repositories\FollowUpCard\FollowUpCardInterface;
use App\AOE\Repositories\FollowUpCardSpecialReport\EloquentFollowUpCardSpecialReport;
use App\AOE\Repositories\FollowUpCardSpecialReport\FollowUpCardSpecialReportInterface;
use App\AOE\Repositories\Reference\EloquentReference;
use App\AOE\Repositories\Reference\ReferenceInterface;
use App\AOE\Repositories\Indexation\EloquentIndexation;
use App\AOE\Repositories\Indexation\IndexationInterface;
use App\AOE\Repositories\Employee\EloquentEmployee;
use App\AOE\Repositories\Employee\EmployeeInterface;

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
        $this->app->singleton(ContractInterface::class, EloquentContract::class);
        $this->app->singleton(InvoiceInterface::class, EloquentInvoice::class);
        $this->app->singleton(VisitInterface::class, EloquentVisit::class);
        $this->app->singleton(FollowUpCardInterface::class, EloquentFollowUpCard::class);
        $this->app->singleton(FollowUpCardSpecialReportInterface::class, EloquentFollowUpCardSpecialReport::class);
        $this->app->singleton(ReferenceInterface::class, EloquentReference::class);
        $this->app->singleton(IndexationInterface::class, EloquentIndexation::class);
        $this->app->singleton(EmployeeInterface::class, EloquentEmployee::class);
    }
}
