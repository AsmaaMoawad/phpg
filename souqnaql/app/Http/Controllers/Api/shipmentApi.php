<?php

namespace App\Http\Controllers\Api;

use Auth;
use JWTAuth;
use Request;
use App\User;
use App\Shipment;
use App\Shipment_receiver;
use Carbon\Carbon;
use App\Shipment_offers;
use Illuminate\Http\Response;  
use App\Http\Controllers\Controller;

class shipmentApi extends Controller
{
	public function index()
	{

		$shipment = Shipment::latest()->pending()->with('shipmentReceivers')->get();
		
		return new \Illuminate\Http\JsonResponse($shipment);
		// return response()->json($shipment);

	}

	public function create(Shipment_offers $shipmentOffers, Request $request, $shipment_id)
	{
		$token = Request::header('token');
		$user = JWTAuth::authenticate($token);

		$data = Request::all();
		$offer = Shipment_offers::create([
			'shipment_id' => $shipment_id,
			'user_id' => Auth::user()->id,
			'price' => $data['offerPrice'],
			'notes' => 'null'
			]);
		if ($offer == true) {

			return 'Add Done';
		}else{
			return 'error';
		}
	}

	public function today(Shipment $shipment, Shipment_offers $shipmentOffers)
	{
		$shipment = Shipment::whereDay('arrival_time', \Carbon\Carbon::now()->day)->whereHas('shipmentOffers', function ($query) {
			$query->where('user_id', Auth::user()->id);
			$query->where('accept', true);
		})->get();

		return response()->json($shipment);
	}

	public function weekly(Shipment $shipment, Shipment_offers $shipmentOffers)
	{
		$week_shipment = Shipment::whereBetween('arrival_time',array(Carbon::now(), Carbon::now()->addWeek()) )->whereHas('shipmentOffers', function ($query) {
			$query->where('user_id', Auth::user()->id);
			$query->where('accept', true);
		})->get();
		return response()->json($week_shipment);

	}

	public function history(Shipment $shipment, Shipment_offers $shipmentOffers)
	{
		$shipment = Shipment::where('status', 'delivery')->whereHas('shipmentOffers', function ($query) {
			$query->where('user_id', Auth::user()->id);
			$query->where('accept', true);
		})->get();

		return response()->json($shipment);
	}



	public function status(Shipment $shipment, $id, $code, $status)
	{
		$shipment = Shipment::find($id);
		$checkCode = $shipment->user->licenceNo;

		if($code == $checkCode) {
			if ($status == 'loading') {
				$shipment->update(['status' => 'loading']);
				return 'Your Shipment Is Loading Now';
			}if ($status == 'delivery') {
				$shipment->update(['status' => 'delivery']);
				return 'You Shipment Is Delivery Now';
			}else{
				return 'You Must Loading Or Delivery';
			}

		}else{
			return 'Wrong Code Shipper';
		}

	}

	public function rate($id, $rate)
	{
		$token = Request::header('token');
		$user = JWTAuth::authenticate($token);
		$shipment = Shipment::find($id)->whereHas('shipmentOffers', function ($query) {
			$query->where('user_id', Auth::user()->id);
			$query->where('accept', true);
		})->first();
		if ($shipment) {
			$shipment->update(['rate' => $rate]);
			return 'Your Rate Is '.$rate ;
		}else{
			return 'You Are Not Deiver This Shipment';
		}
	}



}
