<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = ['number', 'order_number', 'delivery_permission_number', 'finance_approval', 'department', 'release_date', 'descriptions', 'comments'];
    protected $dates = ['release_date'];

    public function setReleaseDateAttribute($date)
    {
        if (!empty($date)){
            $this->attributes['release_date'] = Carbon::parse($date);
        } else {
            $this->attributes['release_date'] = null;
        }
    }

    public function getReleaseDateAttribute($date) {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }
}
