<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('department.department', ['danhsach' => $departments]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
             $validator = \Validator::make($request->all(), [
                'name' => 'required|unique:departments,name',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), 422);
            }
            Department::store($request->all());
            $departments = Department::all();
            return view('department.department_add', ['departments' => $departments]);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
             $validator = \Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), 422);
            }
            $data = $request->all();
            $department = Department::find($id);
            $department->name = $data['name'];
            $department->save();
            $departments = Department::all();
            return view('department.department_add', ['departments' => $departments]);;
        }
    }

    public function destroy($id)
    {
        $department = Department::find($id)->delete();
        return redirect('department')->with('alert', 'Đã xóa phòng ban');

    }
    
    public static function showDepartment(Request $request, $id)
    {   
        $users = User::with('level', 'department')->get()->where('department_id', $id);
        $department = Department::find($id);
        return view('department.department_show', ['department' => $department], ['danhsach' => $users]);
    }
}
