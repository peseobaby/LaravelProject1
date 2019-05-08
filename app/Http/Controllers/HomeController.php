<?php

namespace App\Http\Controllers;

use DB;
use App\Exports\UsersExport;
use App\Mail\ConfirmPassword;
use App\Http\Requests\AddRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UpdateInforRequest;
use App\Services\UserService;
use App\Repositories\LevelRepository;
use App\Services\DepartmentService;
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

    public function __construct(UserService $user, LevelRepository $level, DepartmentService $department)
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
        $user = $this->user->find($id);
        return view('user.user_show', compact('user', 'id'));
    }

    public function destroy(Request $request, $id)
    {
        $this->user->delete($id);
        $users = $this->user->getUser();
        return view('user.search_user', compact('users'));
    }

    public function resetForm()
    {
        $users = $this->user->getUser();
        return view('user.reset_password', compact('users'));
    }

    public function resetPassword(Request $request)
    {
        $this->user->resetPassword($request);
        return redirect()->route('form.reset')->with('alert', 'Reset mật khẩu thành công');
    }

    public function editInfor($id)
    {
        $user = $this->user->find($id);
        return view('user.edit_infor', compact('user', 'id'));
    }

    public function updateInfor(UpdateInforRequest $request, $id)
    {
        $data = $request->all();
        $user = $this->user->updateInfor($data, $id);
        return redirect()->route('user.show', $id)->with('alert', 'Đã cập nhật');
    }

    public function showStaff($id)
    {
        $staffs = $this->user->getStaff($id);
        return view('user.staff', compact('id', 'staffs'));
    }

    public function password($id)
    {
        $user = $this->user->find($id);
        return view('user.change_password', compact('user', 'id'));
    }

    public function changePassword(passwordRequest $request, $id)
    {
        $this->user->changePassword($request, $id);
        return redirect('login')->with('alert', 'Đổi mật khẩu thành công');
    }

    public function export($id)
    {
        return Excel::download(new UsersExport, 'user.xlsx');
    }

    public function search(Request $request)
    {
        $users = $this->user->searchUser($request);
        return view('user.search_user', compact('users'));
    }

    public function modalAdd($id)
    {
        $user = $this->user->showModal($id);
        $departments = $this->department->getAll();
        $levels = $this->level->getLevel();
        return view('user.modal_user_edit',compact('user', 'departments', 'levels'));
    }

    public function store(AddRequest $request)
    {
        $user = $this->user->store($request);
        $users = $this->user->getUser();
        return view('user.search_user', compact('users'));
    }
}