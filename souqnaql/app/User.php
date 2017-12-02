<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;     //
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name', 'email', 'password', 'PersonalImage', 'phone_number', 'Age', 'Address', 'Address_another','Governorate' ,'Activity' , 'notes', 'Name_Company', 'licenceNo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shipmentOffers()
    {
        return $this->hasMany(Shipment_offers::class);
    }

    public function vehicles()
    {
        return $this->belongsTo(Vehicles::class);
    }
    
    public function shipment()
    {
        return $this->hasMany(Shipment::class);
    }
    public function position()
    {
        return $this->hasMany(position::class);
    }
    
}
