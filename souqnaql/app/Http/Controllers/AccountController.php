<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use Image;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $user = Auth::user();
        return view('dashboard.account', compact('user'));
    }



    public function edit(User $user)
    {
        // return Auth::user();
        $user = Auth::user();
        return view('dashboard.updateaccount', compact('user'));
    }


    public function update(Request $request, User $account)
    {
        if($request->has('PersonalImage')){
            
          $avater = $request->file('PersonalImage');
          $filename = Auth::user()->id. Auth::user()->name . '.' . $avater->getClientOriginalExtension();
          Image::make($avater)->resize(300,300)->save( public_path('/uploed/shipper/'.$filename));
        }
        else{
            
            $filename = Auth::user()->PersonalImage;
        }

        $account->update([
            'Name' => $request->Name,
            'Name_Company' => $request->Name_Company,
            'licenceNo' => $request->licenceNo,
            'PersonalImage' => $filename,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'Address' => $request->Address,
            'Governorate' => $request->Governorate,
            'Activity' => $request->Activity,
            'notes' => $request->notes
            ]);
        
        return Redirect::to('accounts/');
    }


// public function destroy(User $user)
// {
//     //
//     $user->delete();
// }

  public function position()
  {
        // if($request->has('position')){
        //     $position = Auth::user()->positions()->create([
        //             'latitude' => $request->input('latitude'),
        //             'longitude' => $request->input('longitude')
        //         ]);
        // }
    return view('position');
}

    public function save(Request $request)
    {
        $last_position = Auth::user()->position()->latest()->take(1)->first();
        if (isset($last_position)) {
            if ($last_position->latitude === Input::get('latitude') && $last_position->longitude ===  Input::get('longitude'))
            {
                $last_position->update(['updated_at'=>new DateTime()]);
            }
        }
        else
        {
            $position = Auth::user()->position()->create(
                $request->only('latitude', 'longitude')
                );
        }

        return $last_position;
    }


}
