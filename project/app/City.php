<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function people()
    {
    	return $this->hasMany('App\Person');
    }

    public function fields()
    {
    	return $this->hasMany('App\Enclosure');
    }
}
