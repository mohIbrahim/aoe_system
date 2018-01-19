<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';
    protected $fillable = ['code', 'notebook_number', 'type', 'received_date', 'malfunctions_type', 'works_done_on_the_machine', 'readings_of_printing_machine', 'comments'];
    protected $dates = ['received_date'];

    public function setReceivedDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['received_date'] = $this->asDateTime($date)->parse($date);
        } else {
            $this->attributes['received_date'] = null;
        }
    }

    public function getReceivedDateAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }
}
