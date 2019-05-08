<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Mail\ConfirmPassword;

class UserService
{
    protected $user;

    function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function getUser() 
    {
        return $this->user->getUser();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function searchUser($request) 
    {
        if ($request->ajax()) {
            $query = $request->query;
            return $this->user->searchUser($query);
        }
    }

    public function resetPassword($request)
    {
        $resetArray = [
            'password' => bcrypt(DEFAULT_PASSWORD),
            'new' => NEW_USER,
        ];
        $ids = $request->all();
        foreach ($ids['box'] as $id ) {
            $this->user->update($id, $resetArray);
            $user = $this->find($id);
            \Mail::to($user->email)
            ->send(new ConfirmPassword($user));
        }
    }

    public function updateInfor($request)
    {
        $updateArray = [
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address,
        ];
        $this->user->update($request->id, $updateArray);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }

    public function changePassword($request, $id)
    {
        $changePassArray = [
            'password' => bcrypt($request->password),
            'new' => CHECKED,
        ];
        $this->user->update($id, $changePassArray);
    }

    public function store($request)
    {
        $data = $request->all();
        if(!$data['id']) {
            $data['password'] = bcrypt(DEFAULT_PASSWORD);
        }
        $this->user->store($data['id'], $data);
    }

    public function showModal($id)
    {
        if($id == NEW_USER) {
            return $this->user->new();
        } else {
            return $this->find($id);
        };
    }

    public function getStaff($id)
    {
        return $this->user->getStaff($id);
    }

    public function getUserDepartment($id)
    {
        return $this->user->getUserDepartment($id);
    }
}
