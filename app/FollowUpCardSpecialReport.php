<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUpCardSpecialReport extends Model
{
    protected $table = 'follow_up_card_special_reports';
    protected $fillable = ['the_date', 'readings_of_printing_machine', 'indexation_number', 'invoice_number', 'the_payment', 'report', 'auditor_name', 'comments'];
    protected $dates = ['the_date'];

    public function setTheDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['the_date'] = $this->asDateTime($date)->parse($date);
        } else {
            $this->attributes['the_date'] = null;
        }
    }

    public function getTheDateAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }
}
