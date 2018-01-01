<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintingMachine extends Model
{
    protected $table = "printing_machines";
    protected $fillable = [
            'code',
            'folder_number',
            'the_manufacture_company',
            'model_prefix',
            'model_suffix',
            'model',
            'serial_number',
            'product_key',
            'manufacturing_year',
            'description',
            'price_without_tax',
            'price_with_tax',
            'is_sold_by_aoe',
            'comments'
    ];
}
