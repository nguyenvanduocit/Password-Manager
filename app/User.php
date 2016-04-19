<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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
     * Add password user can view
     */
    public function passwords(){
        return $this->hasMany('App\Password');
    }
    /**
     * User passwords
     */
    public function ownPasswords(){
        return $this->hasMany('App\Password');
    }
    /**
     * User groups
     */
    public function groups(){
        return $this->belongsToMany('App\Group', 'group_user', 'user_id', 'group_id');
    }
    public function ownGroups(){
        return $this->belongsToMany('App\Group', 'group_user', 'user_id', 'group_id')->where('is_owner', "=", 1);
    }
}
