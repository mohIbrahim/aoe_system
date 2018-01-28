<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['code', 'job_title', 'date_of_hiring', 'salary', 'comments', 'user_id'];
    protected $dates = ['date_of_hiring'];

    public function setDateOfHiringAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['date_of_hiring'] = $this->asDateTime($date);
        } else {
            $this->attributes['date_of_hiring'] = null;
        }
    }

    public function getDateOfHiringAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function theDepartmentThatHeManageIt()
    {
        return $this->hasOne('App\Department', 'manager_id');
    }

    public function assignedReference()
    {
        return $this->hasOne('App\Reference');
    }
}
