<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

	protected $fillable = ['responsible_id','gametype_id','complete','city_id','init_hour'];

    public function city()
    {
    	return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function responsible()
    {
        return $this->belongsTo('App\Person', 'responsible_id', 'id');
    }

    public function gametype()
    {
    	return $this->belongsTo('App\GameType','gametype_id','id');
    }
}
