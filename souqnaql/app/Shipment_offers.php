<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment_offers extends Model
{
	    protected $guarded = [''];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function scopeAccept($query)
    {
        return $query->where('accept', true);
    }

    public function scopeNotAccept($query)
    {
        return $query->where('accept', false);
    }
    public function isAccept()
    {
        if ($this->accept) 
        {
            return true;
        }
        else
        {   
            return false;
        }
    }
}
