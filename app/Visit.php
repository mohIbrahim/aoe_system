<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Visit extends Model
{
    protected $table = 'visits';
    protected $fillable = ['type', 'visit_date', 'representative_customer_name', 'readings_of_printing_machine', 'comments', 'printing_machine_id'];
    protected $dates = ['visit_date'];


    public function setVisitDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['visit_date'] = $this->asDateTime($date);
        } else {
            $this->attributes['visit_date'] = null;
        }
    }

    public function getVisitDateAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }

    public function readingOfPrintingMachine()
    {
        return $this->hasOne('App\ReadingOfPrintingMachine');
    }

    public function indexation()
    {
        return $this->hasOne('App\Indexation');
    }

    public function printingMachine()
    {
        return $this->belongsTo('App\PrintingMachine', 'printing_machine_id', 'id');
    }
}
