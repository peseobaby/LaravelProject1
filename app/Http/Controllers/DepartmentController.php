<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;
use Validator;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    

    public function index()
    {
        $departments = Department::all();
        return view('department.department', compact('departments'));
    }

    public function destroy(Request $request, $id)
    {
       $departments = Department::deleteDepartment($id);
        return view('department.search_department',
                    compact('departments'))->with('alert', 'Đã xóa phòng ban');
    }

    public function showDepartment(Request $request, $id)
    {
        $users = User::WhereUserDepartment($id)->get();
        $department = Department::find($id);
        return view('department.department_show', compact('department', 'users'));
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $departments = Department::searchDepartment($query);
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
                    compact('department'))->withErrors($errors);
    }

    public function post(DepartmentRequest $request)
    {
        $department = Department::postDepartment($request);
        $departments = Department::getAll();
        return view('department.search_department', compact('departments'));
    }

    public function searchUser(Request $request, $id)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $users = User::searchUserDepartment($query, $id);
            return view('department.search_department_user',
                        compact('users'));
        }
    }
}