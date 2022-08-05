<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $user = auth()->user();
    
        if(!$user)
        {
            return redirect()->route('login');
        }

        // redirect user to front end
        if( $user->is_admin == 0 && $user->is_superadmin == 0 )
        {
            return redirect()->route('vue.home');
        }        


        return $next($request);
    }
}
