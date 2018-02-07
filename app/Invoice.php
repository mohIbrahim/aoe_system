<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = ['number', 'type', 'issuer', 'order_number', 'delivery_permission_number', 'finance_check_out', 'release_date', 'descriptions', 'comments', 'indexation_id', 'contract_id'];
    protected $dates = ['release_date'];

    public function setReleaseDateAttribute($date)
    {
        if (!empty($date)){
            $this->attributes['release_date'] = Carbon::parse($date);
        } else {
            $this->attributes['release_date'] = null;
        }
    }

    public function getReleaseDateAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }

    public function setFinanceCheckOutAttribute($data)
    {
        if(!isset($data))
        $this->attributes['finance_check_out'] = 'لم يتم الاطلاع';
        else
        $this->attributes['finance_check_out'] = $data;
    }

    public function indexation()
    {
        return $this->belongsTo('App\Indexation', 'indexation_id');
    }

    public function contract()
    {
        return $this->belongsTo('App\Contract', 'contract_id', 'id');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }
}
