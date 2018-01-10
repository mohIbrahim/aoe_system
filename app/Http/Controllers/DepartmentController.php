<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\AOE\Repositories\Department\DepartmentInterface;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    private $department;


    public function __construct(DepartmentInterface $department)
    {
        $this->department = $department;
        $this->middleware('departments');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->department->latest()->paginate(25);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $department = $this->department->create($request->all());
        flash()->success(' تم إدخال قسم جديد بنجاح. ')->important();
        return redirect()->action('DepartmentController@show', ['id'=>$department->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = $this->department->getById($id);
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = $this->department->getById($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = $this->department->update($id, $request->all());
        flash()->success(' تم تعديل القسم بنجاح. ')->important();
        return redirect()->action('DepartmentController@show', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->department->delete($id);
        flash()->success('تم حذف القسم بنجاح.')->important();
        return redirect()->action('DepartmentController@index');
    }
}
