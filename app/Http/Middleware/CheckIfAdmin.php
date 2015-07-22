<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Hanya admin yang boleh melanjutkan
        if (Auth::user()->group != 'admin') {
            return redirect()->back()->with('dangerMessage', 'Anda bukan Admin');
        }

        return $next($request);
    }
}
