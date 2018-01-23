<?php

namespace App\AOE\Repositories\Employee;

use App\Employee;

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
        $results = $this->employee->where('code', 'like', '%'.$keyword.'%')
                                ->orWhere('job_title', 'like', '%'.$keyword.'%')
                                ->get();
        return $results;
    }

}
