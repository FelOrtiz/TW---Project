<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['enclosure_id', 'name', 'capacity', 'type_id', 'init_hour', 'end_hour'];

    public function enclosures()
    {
    	return $this->belongsTo('App\Enclosure');
    }

    public function fieldType()
    {
    	return $this->belongsTo('App\FieldType');
    }

    public function request()
    {
    	return $this->belongsTo('App\Request');
    }
}
