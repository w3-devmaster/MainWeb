<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( Request $request, Closure $next )
    {
        if ( !getSetting()->login && Auth::user()->type < 100 )
        {
            $request->session()->flush();

            Auth::logout();

            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'ปิดปรับปรุงระบบ Login กรุณาเข้าใช้งานภายหลัง'] );
        }

        return $next( $request );
    }
}