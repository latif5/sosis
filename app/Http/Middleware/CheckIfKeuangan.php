<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfKeuangan
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
        // Hanya keuangan dan admin yang boleh melanjutkan
        if (Auth::user()->group != 'admin' and Auth::user()->group != 'keuangan') {
            return redirect()->back()->with('dangerMessage', 'Anda tidak memiliki akses');
        }

        return $next($request);
    }
}
