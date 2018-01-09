<?php
namespace App\AOE\Repositories\Department;


use App\Department;

class EloquentDepartment implements DepartmentInterface
{
    private $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function getAll()
    {
        $departments = $this->department->all();
        return $departments;
    }


    public function getById($id)
    {
        $department = $this->department->findOrFail($id);
        return $department;
    }


    public function latest($id)
    {
        $department = $this->department->latest();
        return $department;
    }

    public function oldest($id)
    {
        $department = $this->department->oldest();
        return $department;
    }


    public function create(array $attributes)
    {
        $department = $this->department->create($attributes);
        return $department;
    }


    public function update($id, array $attributes)
    {
        $department = $this->department->findOrFail($id);
        $isUpdated = $department->update($attributes);
        return $isUpdatd;
    }


    public function delete($id)
    {
        $department = $this->department->findOrFail($id);
        $isDeleted = $department->delete();
        return $isDeleted;
    }
}
