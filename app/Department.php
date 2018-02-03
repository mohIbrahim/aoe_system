<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = ['name', 'comments'];

    public function manager()
    {
        return $this->hasOne('App\Employee', 'managed_department_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee', 'department_id', 'id');
    }
}
