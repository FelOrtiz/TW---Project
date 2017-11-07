<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'email', 'password', 'role_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public $incrementing = false;

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function person()
    {
        return $this->hasOne('App\Person', 'id', 'id');
    }

    public function isAdmin()
    {
        if($this->role->id == 1)
        {
            return true;
        }

        return false;
    }

    public function isPlayer()
    {
        if($this->role->id == 2)
        {
            return true;
        }
        
        return false;
    }
}
