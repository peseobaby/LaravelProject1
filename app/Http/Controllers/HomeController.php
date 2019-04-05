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
        $users = User::with('level', 'department')->get();
        return view('home', ['danhsach' => $users]);
    }

     public function addUser()
    {   
        $departments = Department::all();
        $levels = Level::where('name', '<>', 'admin')->get();;
        return view('user_add', compact('departments', 'levels'));
    }

    public function store(AddRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        User::store($request->all());
        return redirect('home')->with('alert', 'Đã thêm nhân viên');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $departments = Department::all();
        $levels = Level::where('name', '<>', 'admin')->get();
        return view('user_edit', compact('user', 'id', 'departments', 'levels'));
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('user_show', compact('user', 'id'));
    }

    public function update(UpdateRequest $request, $id)
    {   
        $data = $request->all();
        $user = new User;
        $userid = $user->find($id);
        $userid->name = $data['name'];
        $userid->age = $data['age'];
        $userid->address = $data['address'];
        $userid->level_id = $data['level'];
        $userid->department_id = $data['department'];
        unset($data['_token']);
        unset($data['_method']);
        $userid->save();
        return redirect('home')->with('alert', 'Đã cập nhật');
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect('home')->with('alert', 'Đã xóa nhân viên');
    }

    public function resetForm()
    {   
        $users = User::with('level','department')->get();
        return view('reset_password',['danhsach' => $users]);
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
        return view('edit_infor', compact('user', 'id'));
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
        return view('staff', $data, ['danhsach' => $staffs]);
    }

    public function password($id)
    {
        $user = User::find($id);
        return view('change_password', compact('user', 'id'));
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
    