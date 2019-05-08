<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\DepartmentService;
use Validator;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $department;
    protected $user;

    public function __construct(DepartmentService $department, UserService $user)
    {
        $this->department = $department;
        $this->user = $user;
    }

    public function index()
    {
        $departments = $this->department->getAll();
        return view('department.department', compact('departments'));
    }

    public function destroy(Request $request, $id)
    {
        $department = $this->department->delete($id);
        $departments = $this->department->getAll();
        return view('department.search_department',compact('departments'));
    }

    public function showDepartment(Request $request, $id)
    {
        $users = $this->user->getUserDepartment($id);
        $department = $this->department->find($id);
        return view('department.department_show', compact('department', 'users'));
    }

    public function search(Request $request)
    {
        $departments = $this->department->search($query);
        return view('department.search_department',compact('departments'));
    }

    public function modalAdd($id)
    {
        $department = $this->department->modalAdd($id);
        return view('department.modal_department',compact('department'));
    }

    public function store(DepartmentRequest $request)
    {
        $department = $this->department->store($request);
        $departments = $this->department->getAll();
        return view('department.search_department', compact('departments'));
    }

    public function searchUser(Request $request, $id)
    {
        $users = $this->user->searchUserDepartment($request, $id);
        return view('department.search_department_user', compact('users'));
    }
}