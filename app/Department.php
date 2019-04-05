<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = [
        'name',  
    ];
    public static function getAll()
    {
        return Department::get();
    }
    public static function store($data)
    {   
        $department = new Department;
        $department->name = $data['name'];
        $department->save();
        return $department;
    }
    public static function user()
    {
        return $this->hasMany('App\User', 'id', 'department_id');
    }
}
