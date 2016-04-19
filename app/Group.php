<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = [
		'name', 'description', 'user_id',
	];
	
	public function owners(){
		return $this->belongsToMany('App\User', 'group_user', 'group_id', 'user_id')->where('is_owner','=',1);
	}
	/**
	 * Group's passwords
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function members(){
	    return $this->belongsToMany('App\User', 'group_user', 'group_id', 'user_id')->where('is_owner','<>',1);
    }

	/**
	 * Group's password
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function passwords(){
		return $this->belongsToMany('App\Password');
	}
}
