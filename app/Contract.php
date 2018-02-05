<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $fillable = ['code', 'type', 'start', 'end', 'status', 'price', 'tax', 'total_price', 'payment_system', 'comments', 'printing_machine_id'];

    protected $dates = ['start', 'end'];

    /**
     * [setStartAttribute description]
     * @param [type] $date [description]
     */
    public function setStartAttribute($date)
    {
        if (!empty('start')) {
            $this->attributes['start'] = Carbon::parse($date);
        } else {
            $this->attributes['start']  = null;
        }
    }

    /**
     * [getStartAttribute description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getStartAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }

    /**
     * [setEndAttribute description]
     * @param [type] $date [description]
     */
    public function setEndAttribute($date)
    {
        if (!empty('end')) {
            $this->attributes['end'] = Carbon::parse($date);
        } else {
            $this->attributes['end']  = null;
        }
    }

    /**
     * [getEndAttribute description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getEndAttribute($date)
    {
        if (!empty($date))
            return $this->asDateTime($date)->format('Y-m-d');
    }


    public function InstallationRecord()
    {
        $this->hasOne('App\InstallationRecord');
    }

    public function followUpCard()
    {
        return $this->hasOne('App\FollowUpCard');
    }

    public function printingMachine()
    {
        return $this->belongsTo('App\PrintingMachine', 'printing_machine_id', 'id');
    }

    public function softCopies()
    {
        return $this->morphMany('App\ProjectImages', 'imageable');
    }


}
