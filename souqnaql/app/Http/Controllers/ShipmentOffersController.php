<?php

namespace App\Http\Controllers;

use Auth;
use User;
use App\Shipment;
use App\Shipment_offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ShipmentOffersController extends Controller
{

    public function index(Shipment_offers $userShipments)
    {
        $userShipments = Auth::user()->shipment()->pending()->with('shipmentOffers')->get();       

        return view('dashboard.offers', compact('userShipments'));
    }

    public function update(Request $request, Shipment_offers $offer, Shipment $shipment)
    {
        $offer->update(['accept' => true ]); 
        $shipment = Shipment::find($offer->shipment_id);
        $shipment->update([
            'status' => 'shipping',
            'price' => $offer->price
            ]);
        return Redirect::to('/offers');
    }


    public function destroy(Shipment_offers $shipment_offers)
    {
        //
    }
}
