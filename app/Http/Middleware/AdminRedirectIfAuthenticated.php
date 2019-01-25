<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminRedirectIfAuthenticated
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
        if(Auth::guard('admin')->check()){
            // dd('redirect');
            return response()->view('management.homeAdmin');
            // return redirect()->route('user.index');
            // return new RedirectResponse(url('/user'));
            // return redirect('admin/user');
        }
        return $next($request);
    }
}
