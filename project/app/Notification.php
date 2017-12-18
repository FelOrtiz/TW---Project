<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = ['info','person_id','team_id','viewed'];

    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id', 'id');
    }

	public function team()
    {
    	return $this->belongsTo('App\Team','team_id','id');
    }
}

