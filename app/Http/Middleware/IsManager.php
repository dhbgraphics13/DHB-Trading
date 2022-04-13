<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsManager
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->isManager()) {
            return $next($request);
        }
        return redirect('home');

    }
}
