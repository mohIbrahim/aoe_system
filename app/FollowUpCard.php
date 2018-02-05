<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUpCard extends Model
{
    protected $table = 'follow_up_cards';
    protected $fillable = ['code', 'comments', 'contract_id'];

    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }
}
