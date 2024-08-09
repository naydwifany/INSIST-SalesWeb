<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserPosition
{
    public function handle(Request $request, Closure $next, ...$positions)
    {
        if (Auth::check() && in_array(Auth::user()->UserPosition, $positions)) {
            return $next($request);
        }

        return redirect('/homepage')->with('error', 'You do not have access to this page.');
    }
}