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
use App\Repositories\UserRepository;
use App\Repositories\LevelRepository;
use App\Repositories\DepartmentRepository;
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
    protected $user;
    protected $level;
    protected $department;

    public function __construct(UserRepository $user, LevelRepository $level, DepartmentRepository $department)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->level = $level;
        $this->department = $department;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users =  $this->user->getUser();
        return view('home', compact('users'));
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('user.user_show', compact('user', 'id'));
    }

    public function destroy(Request $request, $id)
    {
       $user = $this->user->delete($id);
       $users = $this->user->getUser();
        return view('user.search_user',
                    compact('users'));
    }

    public function resetForm()
    {
        $users = $this->user->getUser();
        return view('user.reset_password', compact('users'));
    }

    public function resetPassword(Request $request)
    {
        $ids = $request->all();
        foreach ($ids['box'] as $id ) {
            $user = $this->user->resetPassword($id);
            \Mail::to($user->email)
            ->send(new ConfirmPassword($user));
        }
        return redirect()->route('form.reset')
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
        $user = $this->user->updateInfor($data, $id);
        return redirect()->route('user.show', $id)
                         ->with('alert', 'Đã cập nhật');
    }

    public function showStaff($id)
    {
        $staffs = $this->user->getStaff($id);
        return view('user.staff', compact('id', 'staffs'));
    }

    public function password($id)
    {
        $user = User::find($id);
        return view('user.change_password', compact('user', 'id'));
    }

    public function changePassword(passwordRequest $request, $id)
    {
        $user = $this->user->changePassword($request, $id);
        return redirect('login')->with('alert', 'Đổi mật khẩu thành công');
    }

    public function export($id)
    {
        return Excel::download(new UsersExport, 'user.xlsx');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $users = $this->user->searchUser($query);
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
        $departments = $this->department->getAll();
        $levels = $this->level->getLevel();
        return view('user.modal_user_edit',
                compact('user', 'departments', 'levels'));
    }

    public function store(AddRequest $request)
    {
        $user = $this->user->store($request);
        $users = $this->user->getUser();
        return view('user.search_user', compact('users'));
    }
}