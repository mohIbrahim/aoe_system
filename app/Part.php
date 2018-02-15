<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'parts';
    protected $fillable = ['code', 'name', 'type', 'model', 'product_number', 'price_without_tax', 'price_with_tax', 'life', 'qty', 'comments'];

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
