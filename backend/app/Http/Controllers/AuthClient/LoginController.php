<?php

namespace App\Http\Controllers\AuthClient;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'clients/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:web')->except('logout');
        $this->middleware('guest:client')->except('logout');
    }

    protected function guard(){
        return Auth::guard('client');
    }

    protected function redirectTo($request)
    {
        return route('homeClient');
    }

    public function login(Request $request)
    {
        $remember = false;
        if ($this->guard()->attempt(['user_email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->intended(route('homeClient'));
        } else {
            return back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->intended(route('homeClient'));
    }
}
