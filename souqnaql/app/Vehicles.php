<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
	    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
