<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = ['number', 'type', 'issuer', 'order_number', 'delivery_permission_number', 'finance_check_out', 'release_date', 'descriptions', 'total', 'comments', 'collect_date', 'collector_employee_name', 'indexation_id', 'contract_id', 'customer_id'];

    protected $dates = ['release_date', 'collect_date'];

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

    public function setCollectDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['collect_date']  = Carbon::parse($date);
        } else {
            $this->attributes['collect_date'] = null;
        }
    }

    public function getCollectDateAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
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

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function partsForInvoiceTypeSellPart()
    {
        return $this->belongsToMany('App\Part', 'invoice_part', 'invoice_id', 'part_id')
                    ->withPivot(['printing_machines_serial', 'price', 'part_serial_number', 'number_of_parts', 'discount_rate'])
                    ->withTimestamps();
    }
}
