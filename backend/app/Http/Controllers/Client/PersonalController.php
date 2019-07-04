<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\UserClient;

class PersonalController extends Controller
{
    //
    public function Index()
    {
        $data['user'] = $this->getProfile(); 
        
        return view('client.personal', $data);
    }

    public function getProfile(){
        $data = Auth::guard('client')->user();
        return $data;
    }

    public function UpdateProfile(Request $request)
    {
        $user = UserClient::find($this->getProfile()->user_id);

        $user->user_name = $request->name;
        $user->user_birthday = $request->birthday;
        $user->email = $request->email;
        $user->user_phone = $request->phone;
        $user->user_address = $request->address;

        $user->save();

        return back();
    }
  
}
