<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User passwords
     */
    public function passwords(){
        return $this->hasMany('App\Password');
    }
    /**
     * User groups
     */
    public function groups(){
        return $this->belongsToMany('App\Group');
    }
    
    public function ownerGroups(){
        return $this->hasMany('App\Group');
    }
}
