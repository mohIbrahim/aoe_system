<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $fillable = ['code', 'type', 'start', 'end', 'status', 'price', 'tax', 'total_price', 'payment_system', 'comments', 'employee_id_who_edits_the_contract'];

    protected $dates = ['start', 'end'];

    /**
     * [setStartAttribute description]
     * @param [type] $date [description]
     */
    public function setStartAttribute($date)
    {
        if (!empty('start')) {
            $this->attributes['start'] = Carbon::parse($date);
        } else {
            $this->attributes['start']  = null;
        }
    }

    /**
     * [getStartAttribute description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getStartAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }

    /**
     * [setEndAttribute description]
     * @param [type] $date [description]
     */
    public function setEndAttribute($date)
    {
        if (!empty('end')) {
            $this->attributes['end'] = Carbon::parse($date);
        } else {
            $this->attributes['end']  = null;
        }
    }

    /**
     * [getEndAttribute description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getEndAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }


    public function installationRecord()
    {
        return $this->hasOne('App\InstallationRecord', 'contract_of_guarantee_id', 'id');
    }

    public function followUpCard()
    {
        return $this->hasOne('App\FollowUpCard');
    }

    public function printingMachines()
    {
        return $this->belongsToMany('App\PrintingMachine', 'contract_printing_machine', 'contract_id', 'p_machine_id');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }

    public function employeeWhoEditedThisContract()
    {
        return $this->belongsTo('App\Employee', 'employee_id_who_edits_the_contract', 'id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice', 'contract_id', 'id');
    }


}
