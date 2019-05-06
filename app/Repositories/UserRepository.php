<?php
namespace App\Repositories;

use  App\User;

/**
 * 
 */
class UserRepository
{
    protected $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user->WithOutAdmin()->get();
    }

    public function search($strquery, $query)
    {
        if($strquery) {
            $query->where('name', 'like', '%'.$strquery.'%');
            }
            return $query->get();
    }

    public function searchUser($strquery)
    {
        $query = $this->user->WithOutAdmin();
        return $this->search($strquery, $query);
    }

    public function searchUserDepartment($strquery, $department_id)
    {
        $query = $this->user->whereUserDepartment($department_id);
        return $this->search($strquery, $query);
    }

    public function resetPassword($id)
    {
        $user = $this->user->find($id);
        $user->password = bcrypt(DEFAULT_PASSWORD);
        $user->new = NEW_USER;
        $user->save();
        return $user;
    }

    public function delete($id)
    {
        $user = $this->user->where('id', $id)->delete();
        return $this->getUser();
    }

    public function updateInfor($data, $id)
    {
        $user = $this->user->find($id);
        $user->name = $data['name'];
        $user->age = $data['age'];
        $user->address = $data['address'];
        $user->save();
        return $user;
    }

    public function getStaff($id)
    {
        $user = $this->user->find($id);
        return User::with('level', 'department')
                        ->where('department_id', $user->department_id)
                        ->where('level_id', '>', $user->level_id)->get();
    }

    public function changePassword($request, $id)
    {
        $user = $this->user->find($id);
        $user->password = bcrypt($request->password);
        $user->new = CHECKED;
        $user->save();
        return $user;
    }

    public function store($request)
    {
        $data = $request->all();
        if(!$data['id']) {
            $data['password'] = bcrypt(DEFAULT_PASSWORD);
        }
        $this->user->updateOrCreate(['id' => $data['id']], $data);
    }
}