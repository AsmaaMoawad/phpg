<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location_shipment extends Model
{
	    protected $guarded = [''];

    public function shipments()
    {
        return $this->belongsTo(Shipment::class);
    }
}
