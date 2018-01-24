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


    public function latest()
    {
        $departments = $this->department->latest();
        return $departments;
    }

    public function oldest()
    {
        $departments = $this->department->oldest();
        return $departments;
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
        return $isUpdated;
    }


    public function delete($id)
    {
        $department = $this->department->findOrFail($id);
        $isDeleted = $department->delete();
        return $isDeleted;
    }

    public function managerId(Department $department)
    {
        if ($department) {
            if ($department->manager) {
                return $department->manager->id;
            }
        }
        return '';
    }

    public function managerName(Department $department)
    {
        if($department) {
            if ($department->manager) {
                if ($department->manager->user) {
                    return $department->manager->user->name;
                }
            }
        }
        return '';
    }
}
