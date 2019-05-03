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
use App\Http\Requests\UpdateInforRequest;
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
        $users = User::getUser();
        return view('home', compact('users'));
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('user.user_show', compact('user', 'id'));
    }

    public function destroy(Request $request, $id)
    {
       $users = User::deleteUser($id);
        return view('user.search_user',
                    compact('users'))->with('alert', 'Đã xóa phòng ban');
    }

    public function resetForm()
    {
        $users = User::getUser();
        return view('user.reset_password', compact('users'));
    }

    public function resetPassword(PasswordRequest $request)
    {
        $ids = $request->all();
        foreach ($ids['box'] as $id ) {
            $user = User::resetPasswordUser($id);
            \Mail::to($user->email)
            ->send(new ConfirmPassword($user, $userPassword));
        }
        return redirect()->route('resetpassword')
                         ->with('alert', 'Reset mật khẩu thành công');
    }

    public function editInfor($id)
    {
        $user = User::find($id);
        return view('user.edit_infor', compact('user', 'id'));
    }

    public function updateInfor(UpdateInforRequest $request, $id)
    {
        $data = $request->all();
        $user = User::updateInfor($data, $id);
        return redirect()->route('user.show', $id)
                         ->with('alert', 'Đã cập nhật');
    }

    public function showStaff($id)
    {
        $staffs = User::getStaff($id);
        return view('user.staff', compact('id', 'staffs'));
    }

    public function password($id)
    {
        $user = User::find($id);
        return view('user.change_password', compact('user', 'id'));
    }

    public function changePassword(passwordRequest $request, $id)
    {
        $user = User::changePassword($request, $id);
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
            $users = User::searchUser($query);
            return view('user.search_user', compact('users'));
        }
    }

    public function modalAdd($id)
    {
        if($id == NEW_USER) {
            $user = new User;
        } else {
            $user = User::find($id);
        };
        $departments = Department::all();
        $levels = Level::getLevelUser();
        return view('user.modal_user_edit',
                compact('user', 'departments', 'levels'));
    }

    public function post(AddRequest $request)
    {
        $user = User::createOrUpdateUser($request);
        $users = User::getUser();
        return view('user.search_user', compact('users'));
    }
}