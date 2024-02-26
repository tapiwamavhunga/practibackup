<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LockAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
public function handle($request, Closure $next, $guard = null)
    
{
           
    if ($request->session()->has('locked')) {
                    
        return redirect('/lockscreen');
                
        }
            
            

        return $next($request);
    
    }

}
