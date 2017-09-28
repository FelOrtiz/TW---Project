<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'capacity', 'duration'];

    public function players_tw()
    {
        return $this->hasMany('App\PlayerWT');
    }

    public function teams()
    {
        return $this->hasMany('App\Team');
    }
}
