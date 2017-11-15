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
        return $this->belongsTo('App\Team');
    }

    public function person()
    {
        return $this->hasOne('App\Person', 'id', 'person_rut');
    }

}
