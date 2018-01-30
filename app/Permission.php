<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	public 		$table 		= 'permissions';
	protected 	$fillable 	= [ 'name', 'title'];

	public function roles(){
		return $this->belongsToMany('App\Role')->withTimestamps();
	}

}
