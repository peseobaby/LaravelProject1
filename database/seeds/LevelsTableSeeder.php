<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'name' => 'Admin',
        ]);
        DB::table('levels')->insert([
            'name' => 'Giám đốc',
        ]);
        DB::table('levels')->insert([
            'name' => 'Phó giám đốc',
        ]);
        DB::table('levels')->insert([
            'name' => 'Trưởng phòng',
        ]);
        DB::table('levels')->insert([
            'name' => 'Nhân viên',
        ]);
    }
}
