<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PartSerialNumber extends Model
{
    protected $table = 'part_serial_numbers';
    protected $fillable = ['part_id', 'serial_number', 'code', 'availability', 'status', 'date_of_entry', 'date_of_departure', 'comments', 'production_date', 'expiry_date',];
    protected $dates = ['date_of_entry', 'date_of_departure', 'production_date', 'expiry_date'];


    public function setDateOfEntryAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['date_of_entry'] = Carbon::parse($date);
        } else {
            $this->attributes['date_of_entry'] = null;
        }
    }

    public function getDateOfEntryAttribute($date)
    {
        if(!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }


    public function setDateOfDepartureAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['date_of_departure'] = Carbon::parse($date);
        } else {
            $this->attributes['date_of_departure'] = null;
        }
    }

    public function getDateOfDepartureAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }

    public function setProductionDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['production_date'] = $this->asDateTime($date);
        } else {
            $this->attributes['production_date'] = null;
        }
    }

    public function getProductionDateAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
    }
    
    public function setExpiryDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['expiry_date'] = $this->asDateTime($date);
        } else {
            $this->attributes['expiry_date'] = null;
        }
    }

    public function getExpiryDateAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
    }

    public function part()
    {
        return $this->belongsTo('App\Part');
    }


}
