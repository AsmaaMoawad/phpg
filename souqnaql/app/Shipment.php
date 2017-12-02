<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [''];
    protected $appends = ['hasAccepted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipmentOffers()
    {
        return $this->hasMany(Shipment_offers::class);
    }
    
    public function Location_shipment()
    {
        return $this->hasMany(Location_shipment::class);
    }

    public function shipmentReceivers()
    {
        return $this->belongsTo(Shipment_receiver::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }



    public function getHasAcceptedAttribute()
    {
        $accepted = false;
        
        foreach ($this->shipmentOffers as $offer) {
            if ($offer->accept) {
                $accepted = true;
            }
        }

        return $accepted;
        
    }
     
}
