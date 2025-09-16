<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->get('logged_in')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
