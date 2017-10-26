<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['person_id', 'field_id', 'init_hour', 'duration'];

    public function person()
    {
    	return $this->belongsTo('App\Person');
    }

    public function field()
    {
    	return $this->belongsTo('App\Field', 'field_id', 'id');
    }
}
