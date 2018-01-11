<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'parts';
    protected $fillable = ['code', 'name', 'type', 'model', 'product_number', 'price_without_tax', 'price_with_tax', 'life', 'qty', 'comments'];
    
}
