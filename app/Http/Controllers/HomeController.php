<?php

namespace App\Http\Controllers;

use DB;
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
        $users = User::with('level', 'department')
                       ->where('id', '<>', '1')->get();
        $departments = Department::all();
        $levels = Level::where('name', '<>', 'admin')->get();
        return view('home', ['danhsach' => $users,
                             'levels' => $levels,
                             'departments' => $departments,
                            ]);
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('user.user_show', compact('user', 'id'));
    }
    
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        $users = User::where('level_id', '<>', '1')->get();
        $departments = Department::all();
        $levels = Level::where('name', '<>', 'admin')->get();
        return view('user.search_user', ['users' => $users,
                                        'levels' => $levels,
                                        'departments' => $departments,
                                        ])->with('alert', 'Đã xóa nhân viên');
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
            \Mail::to($userid->email)
            ->send(new ConfirmPassword($userid, $userPassword));
        }
        return redirect()->route('resetpassword')
                         ->with('alert', 'Reset mật khẩu thành công');
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
        'age' => 'required|max:120',
        'address' => 'required',
        ]);
        $data = $request->all();
        $user = User::find($id);
        $user->name = $data['name'];
        $user->age = $data['age'];
        $user->address = $data['address'];
        $user->save();
        return redirect()->route('user.show', $id)
                         ->with('alert', 'Đã cập nhật');
    }

    public function showStaff($id)
    {
        $user = User::find($id);
        $data['id'] = $user->id;
        $department_id = $user->department_id;
        $level_id = $user->level_id;
        $staffs = User::with('level', 'department')
                        ->where('department_id', $department_id)
                        ->where('level_id', '>', $level_id)->get();
        return view('user.staff', $data, ['danhsach' => $staffs]);
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

    public function action(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if($query != "") {
                $data = User::with('level', 'department')
                              ->where('id', '<>', 1)
                              ->where(function($qr) use ($query){
                                $qr->orWhere('email', 'like', '%'.$query.'%')
                                   ->orWhere('address', 'like', '%'.$query.'%')
                                   ->orwhere('name', 'like', '%'.$query.'%');
                              })->get();
            } else {
                $data = User::orderBy('id')->where('id', '<>', '1')->get();
            }
            $departments = Department::all();
            $levels = Level::where('name', '<>', 'admin')->get();
            return view('user.search_user', ['users' => $data,
                                            'levels' => $levels,
                                            'departments' => $departments,
                                            ]);
        }
    }

    public function modalAdd($id)
    {
        $errors = request()->get('errors') ?? [];
        if($id == 0) {
            $user = new User;
            $user->id = 0;
        } else {
            $user = User::find($id);
        };
        $departments = Department::all();
        $levels = Level::where('name', '<>', 'admin')->get();
        return view('user.modal_user_edit', ['user' => $user, 
                                             'departments' => $departments,
                                             'levels' => $levels,
                                         ])->withErrors($errors);
    }

    public function post(AddRequest $request)
    {
        $giamdoc = User::where('department_id',     $request->department)
                      ->where('level_id', 2)->first();
        if (($request->level <> 2) || ($giamdoc == null)) {
            $data = $request->all();
            if($data['id'] == 0) {
                $user = new User;
                User::store($request->all());
                return redirect()->back()->with('alert', 'Đã thêm nhân viên');
            } else {
                $data = $request->all();
                $user = User::find($data['id']);
                if ($data['age'] > 15 && $data['age'] < 100) {
                $user->name = $data['name'];
                $user->age = $data['age'];
                $user->address = $data['address'];
                $user->level_id = $data['level'];
                $user->department_id = $data['department'];
                $user->save();
                return redirect()->back()->with('alert', 'Đã cập nhật');
                } else {
                    return redirect()->back()
                    ->with('alert', 'Tuổi phải lớn hơn 15 và nhỏ hơn 100');
                }
            }
        } else {
            return redirect('home')
            ->with('alert', 'Phòng ban đã có giám đốc , chọn chức vụ khác');
        }
    }
}