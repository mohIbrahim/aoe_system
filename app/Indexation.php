<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexation extends Model
{
    protected $table = 'indexations';
    protected $fillable = ['code', 'the_date', 'customer_approval', 'technical_manager_approval', 'warehouse_approval', 'comments', 'visit_id'];

    protected $dates = ['the_date'];

    public function setTheDateAttribute($date)
    {
        if (!empty($date)) {
            $this->attributes['the_date'] = $this->asDateTime($date);
        } else {
            $this->attributes['the_date'] = null;
        }
    }

    public function getTheDateAttribute($date)
    {
        if (!empty($date)) {
            return $this->asDateTime($date)->format('Y-m-d');
        }
    }

    public function setCustomerApprovalAttribute($data)
    {
        if (!isset($data)) {
            $this->attributes['customer_approval'] = 'ليس بعد';
        } else {
            $this->attributes['customer_approval'] = $data;
        }
    }

    public function setTechnicalManagerApprovalAttribute($data)
    {
        if (!isset($data)) {
            $this->attributes['technical_manager_approval'] = 'ليس بعد';
        } else {
            $this->attributes['technical_manager_approval'] = $data;
        }
    }

    public function setWarehouseApprovalAttribute($data)
    {
        if (!isset($data)) {
            $this->attributes['warehouse_approval'] = 'ليس بعد';
        } else {
            $this->attributes['warehouse_approval'] = $data;
        }
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit', 'visit_id');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'indexation_id');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }

    public function parts()
    {
        return $this->belongsToMany('App\Part', 'indexation_part')->withTimestamps()->withPivot('price', 'serial_number', 'number_of_parts', 'discount_rate');
    }
    //this for show view
    public function statementOfRequiredParts()
    {
        $parts = $this->parts;
        $statement  = [];
        $row        = [];
        $totalPrice = 0;
        foreach ($parts as $part) {
            $name           = $part->name;
            $serialNumber   = $part->pivot->serial_number;
            $partPrice      = $part->pivot->price;
            $numberOfParts  = $part->pivot->number_of_parts;
            $discount       = $part->pivot->discount_rate;
            $rowPrice = (($partPrice - (($partPrice*$discount)/100))*$numberOfParts);
            $row = ['name'=>$name, 'serialNumber'=>$serialNumber, 'numberOfParts'=>$numberOfParts, 'partPrice'=>$partPrice, 'discount'=>$discount, 'rowPrice'=>$rowPrice];
            $statement[] = $row;
            $totalPrice += $rowPrice;
        }
        return [$statement, $totalPrice];
    }

}
