<?php

namespace App\Http\Controllers\Api;

use DB; //
// use Auth;
use Image;
use Input;
use Request;
use JWTAuth;
use App\User;
use App\Role;    //
use App\Vehicles;
use Zizaco\Entrust\Traits;  //
// use Illuminate\Http\Request;
use Illuminate\Http\Response;  
use Dingo\Api\Http\FormRequest;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;          // 
use Illuminate\Foundation\Auth\RegistersUsers;      //

class driver_Account_Api_Controller extends Controller

{
//==========================
    protected function register(Request $request)
    {

        $data = Request::all();

        $user = User::create([
            'Name' => $data['Name'],
            // 'PersonalImage' => $data['userImage'],
            'phone_number' => $data['phone_number'],
            'Age' => $data['Age'],
            // 'Address' => $data['Address'],
            'Governorate' => $data['Governorate'],
            'licenceNo' => $data['licenceNo'],
            'password' => bcrypt($data['password']),
            ]);
        // $avater = $request->file('userImage');
        // $avater = $request->file('file');
        // $imageName = time().'.'.$avater->getClientOriginalExtension();
        // $user = Image::make($avater)->resize(300,300)->save( public_path('/uploed/driverImage/'.$imageName));
        // $request->userImage->move(public_path('/uploed/driverImage'), $imageName);

        // return $avater;

        // $avater = $data['userImage'];
        // $filename = $data['Name'].'jpg';
        // Image::make($avater)->resize(300,300)->encode('jpg')->save( public_path('/uploed/driverImage/'.$filename));
        // $user= Auth::user();


        $user->attachRole(Role::find(3));
        // $user->PersonalImage = $filename;

        // $user->vehicles =  Vehicles::create([
        //     'licenceNo' => $data['licenceNo'],
        //     'user_id' => $user->id
        //     ]);


        try {
            if ($user == true) {
                        // return $user;
                return $user->id;
                // return $test = "Welcome";
            }
        } catch (\Exception $e) {
            return  $test = $e ;
        }

        return response()->json(compact('test'));

    }

    
    // Login function
    public function authenticate(Request $request)
    {
        $credentials = Request::only('phone_number', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    // public function GetUserIdByToken(Request $request)
    // {
    //     // $token = $request->token;
    //     $token = Request::header('token');
    //     $user = JWTAuth::authenticate($token);
    //     return $userId = $user->id;
        
    // }

    public function showUserData()
    {
        $token = Request::header('token');
        $user = JWTAuth::authenticate($token);
        $user = User::find($user->id);
        if ($user) {
            return response()->json($user);
        }else{
            return 'You Not User';
        }
    }

    public function UpdateUserData(Request $request)
    {
        $token = Request::header('token');
        $userToken = JWTAuth::authenticate($token);
        $user = User::find($userToken->id);

        $data = Request::all();
        if ($user) {
        $user->update([
            'Name' => $data['Name'],
            'phone_number' => $data['phone_number'],
            'Age' => $data['Age'],
            'Governorate' => $data['Governorate'],
            'licenceNo' => $data['licenceNo'],
            'password' => bcrypt($data['password']),

            ]);
        return response()->json('done');
        }
    }

}
