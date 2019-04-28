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
        return view('department.department', ['danhsach' => $departments]);
    }

    public function destroy($id)
    {
        $department = Department::find($id)->delete();
        $user = User::where('department_id', $id)->delete();
        $departments = Department::all();
        return view('department.search_department',
                    ['departments' => $departments])
               ->with('alert', 'Đã xóa phòng ban');
    }

    public static function showDepartment(Request $request, $id)
    {
        $users = User::with('level', 'department')->where('department_id', $id)
                       ->get();
        $department = Department::find($id);
        return view('department.department_show', ['department' => $department,
                                        'danhsach' => $users]);
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if($query != "") {
                $data = Department::where('name', 'like', '%'.$query.'%')
                                    ->get();
            } else {
                $data = Department::orderBy('id')->get();
            }
            return view('department.search_department',
                        ['departments' => $data]);
        }
    }

    public function modalAdd($id)
    {
        $errors = request()->get('errors') ?? [];
        if($id == 0) {
            $department = new Department;
            $department->id = 0;
        } else {
            $department = Department::find($id);
        };
        return view('department.modal_department',
                    ['department' => $department])->withErrors($errors);
    }

    public function post(DepartmentRequest $request)
    {
        $data = $request->all();
        if($data['id'] == 0) {
            $department = new Department;
            Department::store($request->all());
            return redirect('department')
            ->with('alert', 'Đã thêm phòng ban');
        } else {
            $data = $request->all();
            $department = Department::find($data['id']);
            $department->name = $data['name'];
            $department->save();
            return redirect('department')
            ->with('alert', 'Đã sửa phòng ban');
        }
    }

    public function searchUser(Request $request, $id)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if($query != "") {
                $data = User::with('level', 'department')
                        ->where('department_id', $id)
                        ->where('name', 'like', '%'.$query.'%')->get();
            } else {
                $data = User::with('level', 'department')
                        ->where('department_id', $id)->get();
            }
            return view('department.search_department_user', 
                        ['departments' => $data]);
        }
    }
}
