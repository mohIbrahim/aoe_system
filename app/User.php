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
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Get roles associated with this user.
    *
    * @param
    * @return \App\Role
    */
    public function roles(){
        return $this->belongsToMany('App\Role')->withTimestamps();
    }


	public function images()
	{
		return $this->morphMany('App\ProjectImages', 'imageable');
	}

    public function employee() {
        return $this->hasOne('App\Employee');
    }

    public function invoicesThatIHaveCreated()
    {
        return $this->hasMany('App\Invoice', 'creator_id', 'id');
    }

    public function invoicesThatIHaveUpdated()
    {
        return $this->hasMany('App\Invoice', 'updater_id', 'id');
    }
}
