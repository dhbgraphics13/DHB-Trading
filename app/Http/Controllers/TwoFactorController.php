<?php

namespace App\Http\Controllers;

use App\Models\TwoFactor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('2fa.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = TwoFactor::where('user_id', auth()->user()->id)
          //  ->where('code',$request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();

       if (!$find) {
            return back()->with('error', 'You entered wrong code.');
        }

        if(!Hash::check( $request->code , $find->code ) )
         {
             return back()->with('error', 'You entered wrong code not match.');
        }

        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
            User::updateOrCreate(
                [ 'id' => Auth::user()->id ],
                [ 'email_verified_at' => Carbon::now()->timestamp]
            );

            return redirect()->route('home');
        }

        return back()->with('error', 'You entered wrong code.');
    }



    public function resend()
    {
        Auth::user()->generateCode();
        return back()->with('success', 'We sent you code on your E-mail.');
    }
}
