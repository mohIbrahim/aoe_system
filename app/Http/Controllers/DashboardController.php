<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Closure;
use App\AOE\Repositories\Employee\EloquentEmployee;
use App\Employee;

class DashboardController extends Controller
{
    private $authenticatedUser ;
    private $authenticatedEmployee;
    private $eloquentEmployee;


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware( function($request, Closure $next){
            $this->authenticatedUser = auth()->user();
            $this->authenticatedEmployee = $this->authenticatedUser->employee;
            return $next($request);
        });
        $this->eloquentEmployee = new EloquentEmployee((new Employee()));
    }


    public function dashboard()
    {
        return $this->intendedView();
    }

    public function intendedView()
    {
        $roles = $this->getRoles();
        if ( ($this->getRolesCount($roles)) == 1 ) {
            $name =  $roles->first()->name;
            return $this->callViewByRole(strtolower($name));
        } else {
            //To be containued
            return $this->callViewByRole('');
        }
    }

    public function callViewByRole($name)
    {
        if ($name == 'developer'){
            return $this->developer();
        } else if ($name == 'maintenance engineer') {
            return $this->maintenanceEngineers();
        } else {            
            return $this->userWhithManyRoles();
        }
    }
    
    public function developer()
    {
        return view('dashboard.developer.main');
    }

    public function maintenanceEngineers()
    {
        $engineerData = $this->eloquentEmployee
                             ->composeDateForMaintenanceEngineerDashboard($this->authenticatedEmployee);
        $engineerData['authenticatedEmployeeId'] = $this->authenticatedEmployee->id;
        return view('dashboard.maintenance_engineers.main', $engineerData);
    }

    public function userWhithManyRoles()
    {
        return view('home');
    }

    public function getRoles()
    {
        $roles = $this->authenticatedUser->roles;
        return $roles;
    }

    public function getRolesCount($roles)
    {
        return $roles->count();
    }   

    
}
