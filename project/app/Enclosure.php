<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enclosure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	protected $fillable = ['institution_id', 'name', 'address','city_id','responsible_id'];

    public function city()
    {
    	return $this->belongsTo('App\City');
    }

    public function institution()
    {
    	return $this->belongsTo('App\Institution');
    }

    public function responsible()
    {
        return $this->belongsTo('App\Person', 'responsible_id', 'id');
    }

    public function fields()
    {
        return $this->hasMany('App\Field');
    }
}
