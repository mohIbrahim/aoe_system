<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenceMalfunction extends Model
{
    protected $table = 'reference_malfunctions';
    protected $fillable = ['malfunction_type', 'works_were_done', 'reference_id'];

    public function reference()
    {
        return $this->belongsTo('App\Reference', 'reference_id', 'id');
    }
}
