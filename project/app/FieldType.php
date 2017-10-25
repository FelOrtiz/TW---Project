<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = ['name'];

    public function field()
    {
    	return $this->hasMany('App\Field');
    }
}
