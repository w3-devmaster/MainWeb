<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BannedAccount
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
        if ( Auth::user()->type < 100 )
        {
            if ( DB::connection( 'user' )->table( 'tbl_UserAccount' )->where( 'id', Auth::user()->username )->exists() )
            {
                $user = DB::connection( 'user' )->table( 'tbl_UserAccount' )->where( 'id', Auth::user()->username )->first();

                if ( DB::connection( 'user' )->table( 'tbl_UserAccount' )->where( 'nAccountSerial', $user->serial )->exists() )
                {
                    $ban = DB::connection( 'user' )->table( 'tbl_UserAccount' )->where( 'nAccountSerial', $user->serial )->first();

                    if ( $ban->nPeriod >= 999 )
                    {
                        return redirect( route( 'banned' ) );
                    }
                }
            }
        }

        return $next( $request );

    }
}