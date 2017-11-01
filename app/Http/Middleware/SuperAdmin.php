<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SuperAdmin
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
          if (Auth::user()->user_level != 'Super Admin') {
            return abort(404, 'Unauthorized action.');
          }
      } else {
          return redirect('/');
      }
      return $next($request);
    }
}
