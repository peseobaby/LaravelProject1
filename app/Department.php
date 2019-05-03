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

    public function user()
    {
        return $this->hasMany(User::Class(), 'id', 'department_id');
    }

    public static function deleteDepartment($id)
    {
        $department = Department::find($id)->delete();
        $user = User::where('department_id', $id)->delete();
        return Department::all();
    }

    public static function postDepartment($request)
    {
        $data = $request->all();
        unset($data['_token']);
        return Department::updateOrCreate(['id' => $data['id']], $data);
    }

    public static function searchDepartment($strquery)
    {
        if($strquery) {
            return Department::where('name', 'like', '%'.$strquery.'%')->get();
        } else {
            return Department::orderBy('id')->get();
        }
    }
}
