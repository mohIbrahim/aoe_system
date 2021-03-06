<?php

namespace App\AOE\Repositories\Employee;

use App\Employee;
use App\User;
use App\Role;

class EloquentEmployee implements EmployeeInterface
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    public function getAll()
    {
        $employees = $this->employee->all();
        return $employees;
    }
    public function latest()
    {
        $employees = $this->employee->latest();
        return $employees;
    }
    public function oldest()
    {
        $employees = $this->employee->oldest();
        return $employees;
    }
    public function getById($id)
    {
        $employee = $this->employee->findOrFail($id);
        return $employee;
    }
    public function create(array $attributes)
    {
        $employee = $this->employee->create($attributes);
        return $employee;
    }
    public function update($id, array $attributes)
    {
        $employee = $this->employee->findOrFail($id);
        $employee->update($attributes);
        return $employee;
    }
    public function delete($id)
    {
        $employee = $this->employee->findOrFail($id);
        $isDeleted = $employee->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->employee->with('user', 'theDepartmentThatHeManageIt', 'department')->where('code', 'like', '%'.$keyword.'%')
                                ->orWhere('job_title', 'like', '%'.$keyword.'%')
                                ->orWhereHas('user', function($query) use($keyword){
                                    $query->where('name', 'like', '%'.$keyword.'%');
                                })
                                ->get();
        return $results;
    }

    public function composeDateForMaintenanceEngineerDashboard(Employee $authenticatedEmployee)
    {
        $engineerName = $this->getEmployeeName($authenticatedEmployee);
        $departmentName = $this->getEmployeeDepartmentName($authenticatedEmployee);
        $lastAssignedReferences = $this->getAssignedReferencesForMaintenanceEngineersDashboard($authenticatedEmployee);
        $assignedPrintingMachines = $this->getAssignedPrintingMachinesForMaintenanceEngineersDashBord( $authenticatedEmployee);
        $visits = $this->getVisitsAndIndexationsForMaintenanceEngineersDashboard($authenticatedEmployee);
        $invoices = $this->getInvoicesForMaintenanceEngineerDashboard($authenticatedEmployee);
        // dd($assignedPrintingMachines);
        return compact('engineerName', 'departmentName', 'lastAssignedReferences', 'assignedPrintingMachines', 'visits', 'invoices');
    }

    public function getAssignedReferencesForMaintenanceEngineersDashboard(Employee $authenticatedEmployee)
    {
        return $authenticatedEmployee->assignedReferences()->latest('received_date')->limit(25)->get();
    }

    public function getAssignedPrintingMachinesForMaintenanceEngineersDashBord(Employee $authenticatedEmployee)
    {
        return $authenticatedEmployee->assignedPrintingMachines->load('followUpCards');
    }

    public function getVisitsAndIndexationsForMaintenanceEngineersDashboard(Employee $authenticatedEmployee)
    {
        return $authenticatedEmployee->visits()->with('indexation')->latest('visit_date')->limit(25)->get();
    }

    public function getInvoicesForMaintenanceEngineerDashboard(Employee $authenticatedEmployee)
    {
        return ($authenticatedEmployee->invoicesAtHisOwnRisk);
    }

    public function getEmployeeName(Employee $employee)
    {
        return ($employee->user)?($employee->user->name):('Undefined');
    }

    public function getEmployeeDepartmentName(Employee $employee)
    {
        return ( $employee)?(( $employee->department)?( $employee->department->name):('')):('');
    }

    public function getEmployeesOfMaintenanceEnginerRoleNamesIds()
    {
        $maintenanceEngineersUsers = Role::where('name', 'Maintenance Engineer')->first()->users->load('employee');
        
        $arrayOfEmployeesNamesIds = [];
        foreach ($maintenanceEngineersUsers as $user) {
            if (!empty($user->employee)) {
                $arrayOfEmployeesNamesIds[$user->employee->id] = $user->name;
            }
        }
        $maintenanceEngineersEmployeesNamesIds = collect($arrayOfEmployeesNamesIds);
        return $maintenanceEngineersEmployeesNamesIds;
    }

    /**
     * Report for employees that have invoices and they didn't collect it yet.
     */
    public function getResponsibleEmployeesForInvoicesNotPaidReport()
    {
        $results = [];
        $temporaryInvoicesArray = [];
        $employees = $this->employee->all();
         
        foreach ($employees as $employee) {

            if ($employee->invoicesAtHisOwnRisk->isNotEmpty()) {
                
                $employeeInvoices = $employee->invoicesAtHisOwnRisk;
                foreach ($employeeInvoices as $employeeInvoice) {

                    if (empty($employeeInvoice->collect_date)) {
                        array_push($temporaryInvoicesArray, $employeeInvoice);
                    }

                }
                $results[$employee->employeeName] = $temporaryInvoicesArray;
                $temporaryInvoicesArray = [];
            }
        }
        return $results;
    }

    public function getAuthenticatedEmployee():Employee
    {
        $authenticatedUser =  auth()->user();
        $authenticatedEmployee = (!empty($authenticatedUser))?($authenticatedUser->employee):(new Employee());
        return $authenticatedEmployee;
    }
    

}
