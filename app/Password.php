<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
	protected $fillable = ['title','username','email','password','note','url'];
	/**
	 * Password's owner
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function owner(){
		return $this->belongsTo('App\User');
	}

	/**
	 * Password's groups
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function groups(){
		return $this->belongsToMany('App\Group');
	}
}
