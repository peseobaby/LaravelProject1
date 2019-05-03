<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Level;
use App\Department;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'level_id', 'department_id', 'age', 'address', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function level()
    {
        return $this->hasOne('App\Level', 'id', 'level_id');
    }

    public function department()
    {
        return $this->hasOne('App\Department', 'id', 'department_id');
    }

    public function getAll()
    {
        return User::get();
    }

    public function scopeWhereUserDepartment($query, $id)
    {
        return $query->with('level', 'department')
            ->where('department_id', $id);
    }

    public static function search($strquery, $query)
    {
        if($strquery) {
            $query->where('name', 'like', '%'.$strquery.'%');
            }
            return $query->get();
    }

    public static function searchUser($strquery)
    {
        $query = User::with('level', 'department')->where('level_id', '<>', ADMIN);
        return User::search($strquery, $query);
    }

    public static function searchUserDepartment($strquery, $department_id)
    {
        $query = User::whereUserDepartment($department_id);
        return User::search($strquery, $query);
    }

    public static function getUser()
    {
        return User::with('level', 'department')->where('level_id', '<>', ADMIN)
                ->get();
    }

    public static function resetPasswordUser($id)
    {
        $user = User::find($id);
        $user->password = bcrypt(DEFAULT_PASSWORD);
        $user->new = '0';
        $user->save();
        return $user;
    }

    public static function updateInfor($data, $id)
    {
        $user = User::find($id);
        $user->name = $data['name'];
        $user->age = $data['age'];
        $user->address = $data['address'];
        $user->save();
        return $user;
    }

    public static function deleteUser($id)
    {
        $user = User::where('id', $id)->delete();
        $users = User::getUser();
        return $users;
    }

    public static function getStaff($id)
    {
        $user = User::find($id);
        $department_id = $user->department_id;
        $level_id = $user->level_id;
        $staffs = User::with('level', 'department')
                        ->where('department_id', $department_id)
                        ->where('level_id', '>', $level_id)->get();
        return $staffs;
    }

    public static function changePassword($request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->new = CHECKED;
        $user->save();
        return $user;
    }

    public static function createOrUpdateUser($request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(!$data['id']) {
            $data['password'] = bcrypt(DEFAULT_PASSWORD);
        }
        User::updateOrCreate(['id' => $data['id']], $data);
    }
}
