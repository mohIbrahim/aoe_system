<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\Employee\EmployeeInterface;
use App\Http\Requests\EmployeeRequest;
use App\AOE\JobTitle\JobTitle;


class EmployeeController extends Controller
{
    private $employee;

    public function __construct(EmployeeInterface $employee)
    {
        $this->employee = $employee;
        $this->middleware('auth');
        $this->middleware('employees');
    }

    public function index()
    {
        $employees = $this->employee->latest()->paginate(25);
        return view('employees.index', compact('employees'));
    }


    public function create()
    {
        $jobTitle = new JobTitle();
        $jobsTitles = $jobTitle->getJobTitle();
        return view('employees.create', compact('jobsTitles'));
    }


    public function store(EmployeeRequest $request)
    {
        $employee = $this->employee->create($request->all());
        flash()->success(' تم إضافة الموظف بنجاح. ')->important();
        return redirect()->action('EmployeeController@show', ['id'=>$employee->id]);
    }


    public function show($id)
    {
        $employee = $this->employee->getById($id);
        return view('employees.show', compact('employee'));
    }


    public function edit($id)
    {
        $employee = $this->employee->getById($id);
        $jobTitle = new JobTitle();
        $jobsTitles = $jobTitle->getJobTitle();
        return view('employees.edit', compact('employee', 'jobsTitles'));
    }


    public function update(EmployeeRequest $request, $id)
    {
        $employee = $this->employee->update($id, $request->all());
        flash()->success(' تم تعديل الموظف بنجاح. ')->important();
        return redirect()->action('EmployeeController@show', ['id'=>$id]);
    }


    public function destroy($id)
    {
        $isDeleted = $this->employee->delete($id);
        flash()->success(' تم حذف الموظف بنجاح. ')->important();
        return redirect()->action('EmployeeController@index');
    }

    public function search($keyword)
    {
        return $this->employee->search($keyword);
    }
}
