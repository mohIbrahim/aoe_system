<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintingMachine extends Model
{
    protected $table = "printing_machines";
    protected $fillable = [
            'code',
            'folder_number',
            'status',
            'the_manufacture_company',
            'model_prefix',
            'model_suffix',
            'model',
            'serial_number',
            'product_key',
            'manufacturing_year',
            'description',
            'price_without_tax',
            'price_with_tax',
            'is_sold_by_aoe',
            'comments',
            'customer_id',
            'employee_delivered_the_machine',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function readings()
    {
        return $this->hasMany('App\ReadingOfPrintingMachine', 'printing_machine_id', 'id');
    }

    public function visits()
    {
        return $this->hasMany('App\Visit', 'printing_machine_id', 'id');
    }

    public function contracts()
    {
        return $this->belongsToMany('App\Contract', 'contract_printing_machine' , 'p_machine_id', 'contract_id');
    }

    public function references()
    {
        return $this->hasMany('App\Reference', 'printing_machine_id', 'id');
    }

    public function assignedEmployees()
    {
        return $this->belongsToMany('App\Employee', 'emp_mach_assignments');
    }

    public function installationRecord()
    {
        return $this->hasOne('App\InstallationRecord', 'printing_machine_id', 'id');
    }

    public function followUpCard()
    {
        return $this->hasMany('App\FollowUpCard', 'printing_machine_id', 'id');
    }
}
