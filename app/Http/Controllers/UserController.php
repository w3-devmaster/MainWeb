<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function account()
    {
        $user = Auth::user();
        $ac   = getUserData( $user->username );

        if ( array_key_exists( 'account', $ac ) )
        {
            $game = getGameData( $ac );
        }
        else
        {
            $game = getGameData( $ac, $user->username );
        }

        return view( 'pages.account', compact( 'user', 'ac', 'game' ) );
    }

    public function premium()
    {
        $user = Auth::user();
        $ac   = getUserData( $user->username );

        return view( 'pages.premium', compact( 'user', 'ac' ) );
    }

    public function premium_update( Request $request )
    {
        $user = Auth::user();
        $acc  = User::where( 'id', $user->id )->first();
        $ac   = getUserData( $user->username );

        if ( $user->money >= ( getSetting()->premium * $request->day ) )
        {
            $acc->money = $acc->money - ( getSetting()->premium * $request->day );
            $acc->save();

            if ( $ac['billing']->Status == 1 )
            {
                $end = strtotime( '+' . $request->day . ' days', strtotime( date( 'Y-m-d H:i:s' ) ) );
            }
            elseif ( $ac['billing']->Status == 2 )
            {
                $end = strtotime( '+' . $request->day . ' days', strtotime( $ac['billing']->DTEndPrem ) );
            }
            $update = DB::connection( 'billing' )->table( 'tbl_UserStatus' )->where( 'Serial', $ac['billing']->Serial )->update( ['Status' => 2, 'DTStartPrem' => date( 'Y-m-d H:i:s' ), 'DTEndPrem' => date( 'Y-m-d H:i:s', $end )] );
            if ( $update )
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเสร็จสิ้น เพื่อให้มีผลกรุณาออกเข้าเกมใหม่'] );
            }
            else
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'ดำเนินการล้มเหลว กรุณาติดต่อจีเอ็ม'] );
            }
        }
        else
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'จำนวนเงินของคุณมีไม่เพียงพอต่อการซื้อ'] );
        }

    }

    public function buycash()
    {
        $user = Auth::user();
        $ac   = getUserData( $user->username );

        return view( 'pages.buy-cash', compact( 'user', 'ac' ) );
    }

    public function buycash_update( Request $request )
    {

        $user = Auth::user();
        $acc  = User::where( 'id', $user->id )->first();
        $ac   = getUserData( $user->username );

        if ( $user->money >= $request->bath )
        {
            $acc->money = $acc->money - $request->bath;
            $acc->save();

            $total = floor( getSetting()->exchange * $request->bath );

            $update = DB::connection( 'billing' )->table( 'tbl_UserStatus' )->where( 'Serial', $ac['billing']->Serial )->update( ['Cash' => DB::raw( 'Cash + ' . $total )] );
            if ( $update )
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเสร็จสิ้น'] );
            }
            else
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'ดำเนินการล้มเหลว กรุณาติดต่อจีเอ็ม'] );
            }
        }
        else
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'จำนวนเงินของคุณมีไม่เพียงพอต่อการซื้อ'] );
        }
    }

    public function shop( $cate = null )
    {
        return view( 'pages.shop' );
    }

    public function search_user( Request $request )
    {
        if ( $request->username == null )
        {
            return redirect( route( 'users.index' ) );
        }
        else
        {
            $users = User::where( 'username', $request->username )->paginate( 5 );

            return view( 'admin.users.index', compact( 'users' ) );
        }

    }

}