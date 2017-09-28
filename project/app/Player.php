<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['person_rut', 'team_id', 'team_responsible'];

    public function team()
    {
        return $this->hasOne('App\Team', 'id', 'team_id');
    }

    public function person()
    {
        return $this->hasOne('App\Person', 'rut', 'person_rut');
    }

}
