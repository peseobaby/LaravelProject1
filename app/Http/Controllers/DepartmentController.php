<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;
use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepository;
use Validator;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $department;
    protected $user;

    public function __construct(DepartmentRepository $department, UserRepository $user)
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
        return view('department.search_department',
                    compact('departments'));
    }

    public function showDepartment(Request $request, $id)
    {
        $users = User::WhereUserDepartment($id)->get();
        $department = Department::find($id);
        return view('department.department_show', compact('department', 'users'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $departments = $this->department->search($query);
            return view('department.search_department',
                        compact('departments'));
        };
    }

    public function modalAdd($id)
    {
        if($id == NEW_DEPARTMENT) {
            $department = new Department;
        } else {
            $department = Department::find($id);
        };
        return view('department.modal_department',
                    compact('department'));
    }

    public function store(DepartmentRequest $request)
    {
        $department = $this->department->store($request);
        $departments = $this->department->getAll();
        return view('department.search_department', compact('departments'));
    }

    public function searchUser(Request $request, $id)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $users = $this->user->searchUserDepartment($query, $id);
            return view('department.search_department_user',
                        compact('users'));
        }
    }
}