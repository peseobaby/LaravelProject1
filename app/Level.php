<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function getName()
    {
        return Level::get('name');
    }

    public static function getLevelUser()
    {
        return Level::where('name', '<>', 'admin')->get();
    }
}
