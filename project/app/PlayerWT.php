<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerWT extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['person_id', 'gametype_id', 'hour'];

    protected $table = 'player_wts';

     public function person()
    {
        return $this->hasOne('App\Person', 'rut', 'person_id');
    }

     public function gameType()
    {
        return $this->hasOne('App\GameType', 'id', 'gametype_id');
    }
}