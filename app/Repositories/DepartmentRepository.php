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

    public function store($request)
    {
        $data = $request->all();
        return $this->department->updateOrCreate(['id' => $data['id']], $data);
    }
}