<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'Admin',
        ]);
        DB::table('departments')->insert([
            'name' => 'Giám đốc',
        ]);
        DB::table('departments')->insert([
            'name' => 'Nhân sự',
        ]);
        DB::table('departments')->insert([
            'name' => 'Hành chính',
        ]);
    }
}
