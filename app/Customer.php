<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['code',
                            'name',
                            'type',
                            'email',
                            'website',
                            'responsible_person_name',
                            'address',
                            'area',
                            'district',
                            'city',
                            'governorate',
                            'administration',
                            'department',
                            'comments',
                            'main_branch_id',
                         ];

    public function telecoms()
    {
        return $this->morphMany('App\Telecom', 'telecomable');
    }

    public function mainBranch()
    {
        return $this->belongsTo('App\Customer', 'main_branch_id', 'id');
    }

    public function branches()
    {
        return $this->hasMany('App\Customer', 'main_branch_id', 'id');
    }

    public function printingMachines()
    {
        return $this->hasMany('App\PrintingMachine', 'customer_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice', 'customer_id', 'id');
    }

}
