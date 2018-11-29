<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';
    protected $fillable = ['code', 'notebook_number', 'type', 'status', 'received_date', 'closing_date', 'readings_of_printing_machine', 'informer_name', 'informer_phone', 'reviewed_by_the_chief_engineer', 'comments', 'employee_id', 'employee_id_who_receive_the_reference', 'printing_machine_id'];
    
    protected $dates = ['received_date', 'closing_date'];
    protected $appends = ['assigned_employee_name', 'receiver_employee_name', 'printing_machine_code', 'printing_machine_serial_number', 'printing_machine_folder_number', 'customer_name', 'last_visit_id'];

    
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

    public function getPrintingMachineCodeAttribute():string
    {
        return (isset($this->printingMachine))?($this->printingMachine->code):('');
    }

    public function getPrintingMachineSerialNumberAttribute():string
    {
        return (isset($this->printingMachine))?($this->printingMachine->serial_number):('');
    }

    public function getPrintingMachineFolderNumberAttribute()
    {
        return (isset($this->printingMachine))?($this->printingMachine->folder_number):('');
    }

    public function getCustomerNameAttribute()
    {
        $customerName = '';
        $printingMachine = $this->printingMachine;
        if (isset($printingMachine)) {
            $customer = $printingMachine->customer;
            if (isset($customer)) {
                $customerName = $customer->name;
            }
        }
        return $customerName;
    }

    public function getLastVisitIdAttribute()
    {
        $lastVisitId = '';
        $visits = $this->visits;
        if ($visits->isNotEmpty()) {
            $lastVisitId = $visits->last()->id;
        }
        return $lastVisitId;
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
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
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
