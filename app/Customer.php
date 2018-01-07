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
                            'comments' ];

    public function telecoms()
    {
        return $this->morphMany('App\Telecom', 'telecomable');
    }

}
