<?php
namespace App\Services;

use App\Department;
use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepository;

/**
 * 
 */
class DepartmentService
{
    protected $department;
    protected $user;

    function __construct(DepartmentRepository $department, UserRepository $user)
    {
        $this->department = $department;
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->department->getAll();
    }

    public function find($id)
    {
        return $this->department->find($id);
    }
    public function delete($id)
    {
        $this->department->delete($id);
    }

    public function search($request)
    {
        if ($request->ajax()) {
            $query = $request->query;
            return $departments = $this->department->search($query);
        };
    }

    public function modalAdd($id)
    {
        if($id == NEW_DEPARTMENT) {
            return $this->department->new();
        } else {
            return $this->find($id);
        };
    }

    public function store($request)
    {
        $data = $request->all();
        return $this->department->store($request->id, $data);
    }

    public function searchUserDepartment($request, $id)
    {
        if ($request->ajax()) {
            $query = $request->query;
            return $users = $this->user->searchUserDepartment($query, $id);
        }
    }
}
