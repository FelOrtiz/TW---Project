<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['responsible_id', 'city_id', 'game_type_id', 'complete', 'hour'];

    public function responsible()
   	{
   		return $this->belongsTo('App\Person', 'responsible_id', 'id');
   	}

   	public function city()
   	{
   		return $this->belongsTo('App\City');
   	}

   	public function game_type()
   	{
   		return $this->belongsTo('App\GameType');
   	}
}
