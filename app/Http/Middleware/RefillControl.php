<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefillControl
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
        if ( !getSetting()->refill && Auth::user()->type < 100 )
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'ปิดปรับปรุงระบบเติมเงิน กรุณาเข้าใช้งานภายหลัง'] );
        }

        return $next( $request );
    }
}