<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

	protected $fillable = ['responsible_id','game_type_id','complete','city_id','init_hour', 'searching', 'match_found'];

    public function city()
    {
    	return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function responsible()
    {
        return $this->belongsTo('App\Person', 'responsible_id', 'id');
    }

    public function game_type()
    {
    	return $this->belongsTo('App\GameType','game_type_id','id');
    }
}
