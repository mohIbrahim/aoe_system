<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';
    protected $fillable = ['code', 'notebook_number', 'type', 'received_date', 'malfunctions_type', 'works_done_on_the_machine', 'readings_of_printing_machine', 'comments', 'employee_id'];
    protected $dates = ['received_date'];

    public function setReceivedDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['received_date'] = $this->asDateTime($date);
        } else {
            $this->attributes['received_date'] = null;
        }
    }

    public function getReceivedDateAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }

    public function assignedEmployee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function indexation()
    {
        return $this->hasOne('App\Indexation', 'reference_id');
    }

    public function visits()
    {
        return $this->hasMany('App\Visit', 'reference_id', 'id');
    }
}
