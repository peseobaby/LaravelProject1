<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$department_id = Auth::user()->department_id;
    	$level_id = Auth::user()->level_id;
        return User::with('level','department')->where('department_id', $department_id)->get();
    }
    public function map($user): array
    {
    	return [
    		$user->name,
    		$user->email,
            $user->age,
            $user->address,
    		$user->level->name,
    		$user->department->name,
    	];
    }
    public function headings(): array
    {
        return [
            'Tên',
            'Email',
            'Tuổi',
            'Địa chỉ',
            'Chức vụ',
            'Phòng ban',
        ];
    }
}
