<?php
namespace App\Repositories;

use  App\Level;

/**
 * 
 */
class LevelRepository
{
    protected $level;

    function __construct(level $level)
    {
        $this->level = $level;
    }

    public function getLevel()
    {
        return $this->level->where('name', '<>', 'admin')->get();
    }
}