<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class ReadingOfPrintingMachine extends Model
{
    protected $table = 'reading_of_printing_machines';
    protected $fillable = ['value', 'reading_date', 'comments'];
    protected $dates = ['reading_date'];

    public function setReadingDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['reading_date'] = Carbon::parse($date);
        } else {
            $this->attributes['reading_date'] = null;
        }
    }
}
