<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        // if(Auth::check() && Auth::user()->level === 0){
        //     return $next($request);
        // }else{
        //     return redirect(url("admin/permission"))->with('msg','Bạn không có quyền truy cập trang này');
        // }
        // return redirect(url("login"));
        if(Auth::check()){
            if(Auth::user()->level === 0){
                return $next($request);
            }else{
                return redirect(url("admin/permission"))->with('msg','Bạn không có quyền truy cập trang này');
            }
        }
        return redirect(url("login"));
    }
}
