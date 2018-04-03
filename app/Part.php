<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'parts';
    protected $fillable = ['code', 'name', 'type', 'model', 'location_in_warehouse', 'part_number', 'production_date', 'expiry_date', 'product_number', 'price_without_tax', 'price_with_tax', 'life', 'qty', 'comments'];


    protected $dates = ['production_date', 'expiry_date'];

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



    /**
     * Get sub parts that belongs to this part
     * @return [App\PartSerialNumber] [description]
     */
    public function partSerialNumbers()
    {
        return $this->hasMany('App\PartSerialNumber');
    }
    /**
     * Get the count of sub parts that belongs to this part
     * @return [int] [number of sub parts]
     */
    public function serialNumbersCount()
    {
        return $this->partSerialNumbers()->count();
    }

    public function indexations()
    {
        return $this->belongsToMany('App\Indexation', 'indexation_part')->withTimestamps();
    }

}
