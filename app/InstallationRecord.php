<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InstallationRecord extends Model
{
    protected $table = 'installation_records';
    protected $fillable = [
                    'trainee_name',
                    'installation_date',
                    'feeder_model',
                    'feeder_serial_number',
                    'feeder_product_key',
                    'finisher_model',
                    'finisher_serial_number',
                    'finisher_product_key',
                    'hard_disk_model',
                    'hard_disk_serial_number',
                    'hard_disk_product_key',
                    'paper_drawer_model',
                    'paper_drawer_serial_number',
                    'paper_drawer_product_key',
                    'network_scanner_model',
                    'network_scanner_serial_number',
                    'network_scanner_product_key',
                    'comments',
                    'contract_of_guarantee_id',
                    'employee_id',
                ];
    protected $dates = ['installation_date'];

    public function setInstallationDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['installation_date'] = Carbon::parse($date);
        } else {
            $this->attributes['installation_date'] = null;
        }
    }

    public function getInstallationDateAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
    }

    public function contractOfGuarantee()
    {
        return $this->belongsTo('App\Contract');
    }

    public function responsibleEmployee()
    {
        return $this->belongsTo('App\Employee', 'employee_id','id');
    }
}
