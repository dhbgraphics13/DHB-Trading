<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUser
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->isUser()) {
            return $next($request);
        }
        return redirect('home');

    }
}
