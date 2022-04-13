<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserProfile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Check2FA
{

    public function handle(Request $request, Closure $next)
    {

        if (empty(Auth::user()->email_verified_at) || Auth::user()->two_factor=='Y')
        {
                if (!Session::has('user_2fa')) {
                    Auth::user()->generateCode();
                    return redirect()->route('2fa.index');
                }

        }

        return $next($request);
    }
}
