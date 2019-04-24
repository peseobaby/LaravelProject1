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
    public static function getAll()
    {
        return User::get();
    }
    public static function store($data)
    {   
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt('123456');
        $user->age = $data['age'];
        $user->address = $data['address'];
        $user->level_id = $data['level'];
        $user->department_id = $data['department'];
        $user->save();
        return $user;
    }
}
