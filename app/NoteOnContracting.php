<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteOnContracting extends Model
{
    protected $table = 'notes_on_contracting';
	protected $fillable = ['item_name', 'item_description'];
	
}
