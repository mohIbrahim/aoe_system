<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Auth;

class RoleController extends Controller
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index' ,compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionsGroupedByTitle = Permission::all()->groupBy('title');
        return view('roles.create', compact('permissionsGroupedByTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create( ['name'=>$request->input('name')]);
        $role->permissions()->attach($request->input('permissions'));
        flash()->success('Role has been added successfully');
        return redirect('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('roles.show', compact('role'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissionsGroupedByTitle = Permission::all()->groupBy('title');
        $selectedPermissionsIds = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role','permissionsGroupedByTitle', 'selectedPermissionsIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->update(['name'=>$request->input('name')]);
        $role->permissions()->sync($request->input('permissions'));
        flash()->success('Role has been updated successfully');
        return redirect(action('RoleController@show',[$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $isDeleted = $role->delete();
        if($isDeleted){
            flash()->success('Role has been deleted successfully');
            return redirect('roles');
        }else{
            flash()->warning('Can not delete that role at this time');
            return redirect('roles');
        }
    }








}
