<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telecom extends Model
{
    protected $table="telecoms";
    protected $fillable =  ['telecomable_id', 'telecomable_type', 'number', 'type'];


    public function telecomable()
    {
        return $this->morphTo();
    }
}
