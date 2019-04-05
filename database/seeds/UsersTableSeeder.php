<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Trần Duy Hưng',
            'email' => 'admin'.'@gmail.com',
            'password' => bcrypt('123'),
            'age' => 24,
            'address' => 'Hai phong',
            'level_id' => 1,
            'department_id' => 1,
        ]);
        factory(App\User::class, 20)->create();
    }
}
