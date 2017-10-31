<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitation extends Model
{
    protected $fillable = ['person_id', 'field_id', 'init_hour', 'duration'];

    public function person()
    {
    	return $this->belongsTo('App\Person');
    }

    public function field()
    {
    	return $this->belongsTo('App\Field');
    }
}
