<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HospitalMiddleware
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
        if (Auth::check()) {
          # code...
          $currentLoggedUser = Auth::user()->load('healthFacility');
          if ($currentLoggedUser->healthFacility->level === 'HOSPITAL' || $currentLoggedUser->healthFacility->level === 'REFERRAL') {
            # code...
            return $next($request);
          }

          return redirect()->route('dashboard')->with('error', 'You DO NOT have Permision to access HOPSITAL resource, Your Level is => '. $currentLoggedUser->healthFacility->level);
        }

    }
}
