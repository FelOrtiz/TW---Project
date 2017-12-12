<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'cellphone', 'birthdate', 'city_id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id');
    }

    public function city()
    {
    	return $this->belongsTo('App\City');
    }

    public function solicitations()
    {
        return $this->hasMany('App\Solicitation');
    }

    public function name()
    {
        return ucfirst($this->firstname).' '.ucfirst($this->lastname);
    }
}
