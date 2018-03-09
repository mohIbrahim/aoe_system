<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUpCard extends Model
{
    protected $table = 'follow_up_cards';
    protected $fillable = ['code', 'comments', 'contract_id', 'printing_machine_id'];

    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }

    public function visits()
    {
        return $this->hasMany('App\Visit', 'follow_up_card_id', 'id');
    }

    public function specialReports()
    {
        return $this->hasMany('App\FollowUpCardSpecialReport', 'follow_up_card_id', 'id');
    }

    public function printingMachine()
    {
        return $this->belongsTo('App\PrintingMachine', 'printing_machine_id', 'id');
    }
}
