<?php

namespace App\Http\Controllers\Api;

use DB; //
use Auth;
use Input;
use Request;
use JWTAuth;
use App\User;
use App\Vehicles;
use Illuminate\Http\Response;  
use App\Http\Controllers\Controller;

class vehicleApi extends Controller

{
    public function create(Request $request, Vehicles $vehicles, $id)
    {
        $user = \App\User::find($id);
        $data = Request::all();


        Vehicles::create([
            'CarType' => $data['CarType'],
            'Model' => $data['Model'],
            'Year' => $data['Year'],
            'Weight' => $data['Weight'],
            'plateNo' => $data['plateNo'],
            'user_id' => $user->id
            ]);

        if ($vehicles == true) {
            return 'done';
        }else
        {
            return 'no';
        }

    }


    public function showVehicleData(Vehicles $vehicle)
    {
        $token = Request::header('token');
        $user = JWTAuth::authenticate($token);
        $vehicle = Vehicles::where('user_id',$user->id)->first();
        if ($vehicle) {
            return response()->json($vehicle);
        }else{
            return 'You Not User';
        }
    }

    public function UpdateVehicleData(Request $request, Vehicles $vehicle)
    {
        $token = Request::header('token');
        $user = JWTAuth::authenticate($token);

        $vehicle = Vehicles::where('user_id',$user->id)->first();

         $data = Request::all();
        if ($vehicle) {
        $vehicle->update([
            'CarType' => $data['CarType'],
            'Model' => $data['Model'],
            'Year' => $data['Year'],
            'Weight' => $data['Weight'],
            'plateNo' => $data['plateNo'],
            ]);
        return 'done';
        }
    }

}