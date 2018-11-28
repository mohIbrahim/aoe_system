<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';
    protected $fillable = ['code', 'notebook_number', 'type', 'status', 'received_date', 'closing_date', 'readings_of_printing_machine', 'informer_name', 'informer_phone', 'reviewed_by_the_chief_engineer', 'comments', 'employee_id', 'employee_id_who_receive_the_reference', 'printing_machine_id'];
    
    protected $dates = ['received_date', 'closing_date'];
    protected $appends = ['assigned_employee_name', 'receiver_employee_name'];

    
    //////////////////
    //// Accesors ////
    //////////////////
    public function getReceivedDateAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }
    /**
     * Getting the name of the employee who assigned to reference.
     * it's the maintenance engineer.
     *
     * @return string
     */
    public function getAssignedEmployeeNameAttribute():string
    {
        return (isset($this->assignedEmployee))?($this->assignedEmployee->employee_name):('');
    }
    
    public function getReceiverEmployeeNameAttribute()
    {
        return (isset($this->employeeWhoReceiveTheRereference))?($this->employeeWhoReceiveTheRereference->employee_name):('');
    }

    //////////////////
    //// Mutators ////
    //////////////////
    public function setReceivedDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['received_date'] = $this->asDateTime($date);
        } else {
            $this->attributes['received_date'] = null;
        }
    }

    ///////////////////////
    //// Relationships ////
    ///////////////////////
    public function assignedEmployee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function visits()
    {
        return $this->hasMany('App\Visit', 'reference_id', 'id');
    }

    public function employeeWhoReceiveTheRereference()
    {
        return $this->belongsTo('App\Employee', 'employee_id_who_receive_the_reference', 'id');
    }

    public function printingMachine()
    {
        return $this->belongsTo('App\PrintingMachine', 'printing_machine_id', 'id');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }

    public function malfunctions()
    {
        return $this->hasMany('App\ReferenceMalfunction', 'reference_id', 'id');
    }
    ///////////////////////
    //// Miscellaneous ////
    ///////////////////////
    
}
