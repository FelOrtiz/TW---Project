<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['name', 'responsible_rut'];

    public function enclosures()
    {
    	return $this->hasMany('App\Enclosure');
    }
}
