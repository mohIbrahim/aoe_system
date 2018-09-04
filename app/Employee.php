<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['code', 'job_title', 'date_of_hiring', 'salary', 'comments', 'user_id', 'managed_department_id', 'department_id'];
    protected $dates = ['date_of_hiring'];


    public function getCodeAttribute($code)
    {
        return (isset($code)?$code:'');
    }

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

    public function getEmployeeNameAttribute()
    {
        return (!empty($this->user))?($this->user->name):('');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function theDepartmentThatHeManageIt()
    {
        return $this->belongsTo('App\Department', 'managed_department_id', 'id');
    }

    /**
     * Assigned References To Maintenance Engineers
     */
    public function assignedReferences()
    {
        return $this->hasMany('App\Reference', 'employee_id', 'id');
    }

    /**
    * The references that received by admins
    *
    **/
    public function theReferencesThatReceived()
    {
        return $this->hasMany('App\Reference', 'employee_id_who_receive_the_reference', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function installationRecords()
    {
        return $this->hasMany('App\InstallationRecord', 'employee_id', 'id');
    }

    /**
     * Contracts that Salesman edits it.
     */
    public function contracts()
    {
        return $this->hasMany('App\Contract', 'employee_id_who_edits_the_contract', 'id');
    }

    /**
     * Visits that any employee specially maintenance employee doing it.
     */
    public function visits()
    {
        return $this->hasMany('App\Visit', 'the_employee_who_made_the_visit_id', 'id');
    }

    public function assignedPrintingMachines()
    {
        return $this->belongsToMany('App\PrintingMachine', 'emp_mach_assignments')->withTimestamps();
    }

    /**
     * invoice that any employee responsible for it.
     */
    public function invoicesAtHisOwnRisk()
    {
        return $this->belongsToMany('App\Invoice', 'employee_invoice_responsibilities', 'employee_id', 'invoice_id');
    }

    public function indexations()
    {
        return $this->hasMany(Indexation::class, 'performed_employee_id', 'id');
    }
}
