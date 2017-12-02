<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment_receiver extends Model
{

    protected $guarded = [''];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
    
}
