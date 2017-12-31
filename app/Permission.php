<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	public 		$table 		= 'permissions';
	protected 	$fillable 	= [ 'name'];	

	public function roles(){
		return $this->belongsToMany('App\Role')->withTimestamps();
	}

}
