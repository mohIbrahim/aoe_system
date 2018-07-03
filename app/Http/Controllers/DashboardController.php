<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Closure;

class DashboardController extends Controller
{
    private $authenticatedUser ;
    private $authenticatedEmployee;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware( function($request, Closure $next){
            $this->authenticatedUser = auth()->user();
            $this->authenticatedEmployee = $this->authenticatedUser->employee;
            return $next($request);
        });   
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
        $lastAssignedReferences =  $this->authenticatedEmployee->assignedReferences()->latest('received_date')->limit(25)->get();
        $engineerName = $this->authenticatedUser->name;
        $departmentName = ( $this->authenticatedEmployee)?(( $this->authenticatedEmployee->department)?( $this->authenticatedEmployee->department->name):('')):('');
        return view('dashboard.maintenance_engineers.main', compact('lastAssignedReferences', 'engineerName', 'departmentName'));
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
