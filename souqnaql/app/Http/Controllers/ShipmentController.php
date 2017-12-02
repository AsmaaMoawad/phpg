<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Shipment;
use App\Shipment_receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ShipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $shipments = Shipment::orderBy('arrival_time', 'desc')->get(); 
         $shipments = Auth::user()->shipment()->get();       
        return view('shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'origin' => 'required|max:191',
            'destination' => 'required|max:191'
            ]);



        $shipment = Auth::user()->shipment()->create([
            'type' => $request->type,
            'start_point_latitude' => $request->start_point_latitude,
            'start_point_longitude' => $request->start_point_longitude,
            'end_point_latitude' => $request->end_point_latitude,
            'end_point_longitude' => $request->end_point_longitude,
            'from' => $request->origin,
            'to' => $request->destination,
            'price' => $request->price,
            'load_type' => $request->load_type,
            'arrival_time' => $request->arrival_time,
            'inital_time' => $request->inital_time,
            'notes' => $request->notes
            ]);

         Shipment_receiver::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'shipment_id' => $shipment->id
            ]);

        return Redirect::to('/shipments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        //
        return view('Shipments.show', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        //
        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        //
        $shipment->delete();
    }
}
