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
    	return view('department', ['danhsach' => $departments]);
    }

    public function addDepartment()
    {
    	return view('department_add');
    }

    public function store(DepartmentRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        Department::store($request->all());
        return redirect('department')->with('alert', 'Đã thêm phòng ban');;
    }

    public function editDepartment($id)
    {
        $department = Department::find($id);
        return view('department_edit', compact('department','id'));
    }

      public function update(DepartmentRequest $request, $id)
    {   
        $department = new Department;
        $data = $request->all();
        $departmentid = $department->find($id);
        $departmentid->name = $data['name'];
        unset($data['_token']);
        unset($data['_method']);
        $departmentid->save();
        return redirect('department')->with('alert', 'cập nhật thành công');
    }

    public function destroy($id)
    {
        $department = Department::find($id)->delete();
        return redirect('department')->with('alert', 'Đã xóa phòng ban');

    }
    
    public static function showDepartment(Request $request, $id)
    {   
    	$users = User::with('level','department')->get()->where('department_id', $id);
        $department = Department::find($id);
        return view('department_show', ['department' => $department], ['danhsach' => $users]);
    }
}
