<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = ['name', 'comments', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo('App\Employee');
    }
}
