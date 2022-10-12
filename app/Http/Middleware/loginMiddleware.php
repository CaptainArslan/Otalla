<?php

namespace App\Http\Middleware;

use App\Catalog;
use Closure;
use Illuminate\Http\Request;

class loginMiddleware
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
        if (Session('user_id') != '' && Session('order_number') != '') {
            // return response()->redirect('dashboard');
            $catalogs = Catalog::all();
            return response()->view('dashboard',compact('catalogs'));
        } else {
            return redirect('login');
        }
        return $next($request);
    }
}
