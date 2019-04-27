<?php

namespace App\Http\Controllers;

use App\User;
use App\Level;
use App\Department;
use App\Exports\UsersExport;
use App\Mail\ConfirmPassword;
use App\Http\Requests\AddRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $departments = Department::all();
        $levels = Level::where('name', '<>', 'admin')->get();;
        $users = User::with('level', 'department')->where('level_id', '<>', '1')->get();
        return view('home', ['danhsach' => $users,
                             'departments' => $departments,
                             'levels' => $levels,
                            ]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
             $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'age' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), 422);
            }
            User::store($request->all());
            $users = User::where('level_id', '<>', '1')->get();
            return view('user.user_add', ['users' => $users])->with('alert', 'Đã thêm nhân viên');
        }
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('user.user_show', compact('user', 'id'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
             $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'age' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), 422);
            }
            $data = $request->all();
            $user = User::find($id);
            $user->name = $data['name'];
            $user->age = $data['age'];
            $user->address = $data['address'];
            $user->level_id = $data['level'];
            $user->department_id = $data['department'];
            $user->save();
            $users = User::where('level_id', '<>', '1')->get();
            return view('user.user_add', ['users' => $users]);;
        }
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect('home')->with('alert', 'Đã xóa nhân viên');
    }

    public function resetForm()
    {   
        $users = User::with('level', 'department')->get();
        return view('user.reset_password', ['danhsach' => $users]);
    }

    public function resetPassword(Request $request)
    {
        $userPassword = '123456';
        $ids = $request->all();
        foreach ($ids['box'] as $id ) {
            $user = new User;
            $userid = $user->find($id);
            $userid->password = bcrypt($userPassword);
            $userid->new = '0';
            $userid->save();
            \Mail::to($userid->email)->send(new ConfirmPassword($userid, $userPassword));
        }
         return redirect('home')->with('alert', 'Reset mật khẩu thành công');
    }

    public function editInfor($id)
    {
        $user = User::find($id);
        return view('user.edit_infor', compact('user', 'id'));
    }

    public function updateInfor(Request $request, $id)
    {
       $validatedData = $request->validate([
        'name' => 'required',
        'age' => 'required',
        'address' => 'required',
        ]);
        $data = $request->all();
        $user = new User;
        $userid = $user->find($id);
        $userid->name = $data['name'];
        $userid->age = $data['age'];
        $userid->address = $data['address'];
        $userid->save();
        return redirect()->route('user.show', $id)->with('alert', 'Đã cập nhật'); 

    }

    public function showStaff($id)
    {
        $user = User::find($id);
        $data['id'] = $user->id;
        $department_id = $user->department_id;
        $level_id = $user->level_id;
        $staffs = User::with('level','department')->where('department_id', $department_id)
        ->where('level_id', '>', $level_id)->get();
        return view('department.staff', $data, ['danhsach' => $staffs]);
    }

    public function password($id)
    {
        $user = User::find($id);
        return view('user.change_password', compact('user', 'id'));
    }

    public function changePassword(passwordRequest $request, $id)
    {   
        $checked = '1';
        $user = new User;
        $data = $request->all();
        $userid = $user->find($id);
        $userid->password = bcrypt($data['password']);
        $userid->new = $checked;
        $userid->save();
        return redirect('login')->with('alert', 'Đổi mật khẩu thành công');
    }
    
    public function export($id)
    {
        return Excel::download(new UsersExport, 'user.xlsx');
    }
}
    