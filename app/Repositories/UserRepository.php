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

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function new()
    {
        return new User;
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

    public function update($id, $data)
    {
        return $this->user->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }

    public function getStaff($id)
    {
        $user = $this->user->find($id);
        return $this->user->with('level', 'department')
                        ->where('department_id', $user->department_id)
                        ->where('level_id', '>', $user->level_id)->get();
    }

    public function getUserDepartment($id)
    {
        return User::WhereUserDepartment($id)->get();
    }

    public function store($id, $data)
    {
        $this->user->updateOrCreate(['id' => $id], $data);
    }
}