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
    protected $fillable = ['person_id', 'team_id', 'team_responsible'];

    public function team()
    {
        return $this->belongsTo('App\Team','team_id','id');
    }

    public function person()
    {
        return $this->hasOne('App\Person', 'id', 'person_rut');
    }

}
