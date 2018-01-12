<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PartSerialNumber extends Model
{
    protected $table = 'part_serial_numbers';
    protected $fillable = ['serial_number', 'availability', 'status', 'date_of_entry', 'date_of_departure', 'comments'];
    protected $dates = ['date_of_entry', 'date_of_departure'];


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


}
