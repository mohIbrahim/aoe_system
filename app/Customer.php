<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
                            'sector',
                            'code',
                            'name',
                            'type',
                            'email',
                            'website',
                            'responsible_person_name',
                            'responsible_person_phone',
                            'responsible_person_email',
                            'address',
                            'area',
                            'district',
                            'city',
                            'governorate',
                            'administration',
                            'department',
                            'comments',
                            'main_branch_id',
                            'accounts_dep_emp_name',
                            'accounts_dep_emp_phone',
                            'accounts_dep_emp_email',
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
