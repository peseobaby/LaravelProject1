<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function getName()
    {
        return Level::get('name');
    }
}
