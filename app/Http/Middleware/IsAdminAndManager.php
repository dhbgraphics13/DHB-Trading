<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminAndManager
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->isAdmin() || auth()->user()->isManager())
        {
            return $next($request);
        }
        return redirect('home');
    }
}
