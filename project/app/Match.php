<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['v_team_id', 'l_team_id', 'solicitation_id'];

    public function v_team()
    {
        return $this->hasOne('App\Team', 'id', 'v_team_id');
    }

    public function l_team()
    {
        return $this->hasOne('App\Team', 'id', 'l_team_id');
    }

    public function request()
    {
        return $this->hasOne('App\Solicitation', 'id', 'solicitation_id');
    }
}
