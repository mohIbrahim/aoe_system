<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
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
            return $this->callView(strtolower($name));
        } else {
            //To be containued
            return $this->callView('');
        }
    }

    public function callView($name)
    {
        if ($name == 'developer'){
            return $this->developer();
        } else {            
            return $this->userWhithManyRoles();
        }
    }
    
    public function developer()
    {
        return auth()->user()->employee->assignedReferences;
        return view('dashboard.developer.main');
    }

    public function maintenanceEngineers()
    {

    }

    public function userWhithManyRoles()
    {
        return view('home');
    }

    public function getRoles()
    {
        $roles = auth()->user()->roles;
        return $roles;
    }

    public function getRolesCount($roles)
    {
        return $roles->count();
    }   

    
}
