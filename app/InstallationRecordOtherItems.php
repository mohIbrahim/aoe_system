<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallationRecordOtherItems extends Model
{
    protected $table = 'i_r_other_items';
    protected $fillable = ['installation_record_id', 'item_name', 'item_description'];

    public function installationRecord()
    {
        return $this->belongsTo('App\InstallationRecord', 'installation_record_id', 'id');
    }
}
