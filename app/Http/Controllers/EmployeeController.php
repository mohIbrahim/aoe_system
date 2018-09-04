<?php

namespace App\Http\Controllers;

use App\AOE\Repositories\Employee\EmployeeInterface;
use App\Http\Requests\EmployeeRequest;
use App\AOE\JobTitle\JobTitle;
use App\User;
use App\Department;
use App\PrintingMachine;
use \App\AOE\Repositories\PrintingMachine\EloquentPrintingMachine;

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
        $usersNames = User::all()->pluck('name', 'id');
        $managedDepartmentsIdsNames = Department::all()->pluck('name', 'id');
        $departmentsIdsNames = Department::all()->pluck('name', 'id');
        return view('employees.create', compact('jobsTitles', 'usersNames', 'managedDepartmentsIdsNames', 'departmentsIdsNames'));
    }


    public function store(EmployeeRequest $request)
    {
        $employee = $this->employee->create($request->all());
        $employee->assignedPrintingMachines()->attach($request->assigned_machines_ids);
        flash()->success(' تم إنشاء الموظف بنجاح. ')->important();
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
        $usersNames = User::all()->pluck('name', 'id');
        $managedDepartmentsIdsNames = Department::all()->pluck('name', 'id');
        $departmentsIdsNames = Department::all()->pluck('name', 'id');

        return view('employees.edit', compact('employee', 'jobsTitles', 'usersNames', 'managedDepartmentsIdsNames', 'departmentsIdsNames'));
    }


    public function update(EmployeeRequest $request, $id)
    {
        $employee = $this->employee->update($id, $request->all());
        $employee->assignedPrintingMachines()->sync($request->assigned_machines_ids);
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

    public function searchingOnPrintingMachine($keyword)
    {
        $abc = new EloquentPrintingMachine(new PrintingMachine());
        return $abc->searchLimitedCodeCustomer($keyword);
    }

    public function getResponsibleEmployeesForInvoicesNotPaidReport()
    {
        $employeesInvoices = $this->employee->getResponsibleEmployeesForInvoicesNotPaidReport();
        return view('employees.reports.responsible_employees_for_invoices_not_paid_report', compact('employeesInvoices'));
    }
}
