<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public    $table    = 'roles';
    protected $fillable = ['name'];
	
   	

  	public function getPermissionListAttribute(){
  		return $this->permissions->pluck('id');
  	}

    public function permissions(){
      return $this->belongsToMany('App\Permission')->withTimestamps();
    }

	/**
	* Get users associated with this role.
	*
	* @param  
	* @return \App\User
	*/
  	public function users(){
  		return $this->belongsToMany('App\User')->withTimestamps();
  	}
}

 