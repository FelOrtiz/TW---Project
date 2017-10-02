<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['name', 'responsible_id'];

    public function enclosures()
    {
    	return $this->hasMany('App\Enclosure');
    }

    public function responsible()
    {
        return $this->belongsTo('App\Person', 'responsible_id', 'id');
    }
}
