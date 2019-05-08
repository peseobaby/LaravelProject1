<?php
namespace App\Repositories;

use  App\Department;
use App\User;

/**
 * 
 */
class DepartmentRepository
{
    protected $department;
    protected $user;

    function __construct(Department $department, User $user)
    {
        $this->department = $department;
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->department->all();
    }

    public function find($id)
    {
        return $this->department->find($id);
    }

    public function new($id)
    {
        return new Department;
    }

    public function delete($id)
    {
        $department = $this->department->where('id', $id)->delete();
        $user = $this->user->where('department_id', $id)->delete();
    }

    public function search($strquery)
    {
        if($strquery) {
            return $this->department->where('name', 'like', '%'.$strquery.'%')->get();
        }
        return $this->getAll();
    }

    public function store($id, $data)
    {
        return $this->department->updateOrCreate(['id' =>$id], $data);
    }
}