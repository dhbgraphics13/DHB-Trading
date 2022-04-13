<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



   public function login(Request $request)
    {
      //  $this->validateLogin($request);
        $request->validate([
            'username' => 'required|string|max:12|regex:/^[A-Za-z]+$/',
            'password' => 'required|max:255',
        ],
            [
                'username.required' =>'Username Required',
                'username.regex' =>'space & Special characters are not Allowed.',
            ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if($this->guard()->validate($this->credentials($request))) {
            if(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'active' => 'Y'])) {
                return redirect()->route('home');
            }  else {
                $this->incrementLoginAttempts($request);
                return redirect()->back()->with('message', 'This account is not activated.');
            }
        } else {
            // dd('ok');
            $this->incrementLoginAttempts($request);
            return redirect()->back()->with('error', 'Access Denied ! Invalid Email or Password.');
        }
    }




    public function username()
    {
        return 'username';
    }


    public function logout(Request $request)
    {
        auth()->logout();
        Session::flush();
        return redirect()->route('login');
    }


}
