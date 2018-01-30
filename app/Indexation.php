<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexation extends Model
{
    protected $table = 'indexations';
    protected $fillable = ['code', 'the_date', 'customer_approval', 'technical_manager_approval', 'warehouse_approval', 'comments', 'reference_id', 'visit_id'];

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

    public function reference()
    {
        return $this->belongsTo('App\Reference', 'reference_id');
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit', 'visit_id');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'indexation_id');
    }

}
