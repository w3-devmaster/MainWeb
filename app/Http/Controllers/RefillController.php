<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRefillRequest;
use App\Http\Requests\UpdateRefillRequest;
use App\Models\Refill;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RefillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( !Schema::hasColumn( 'settings', 'take_money' ) )
        {
            Artisan::call( 'migrate' );
        }
        $date_take = getSetting()->take_money;

        $wait  = Refill::where( 'status', 0 )->orderBy( 'created_at' )->get();
        $succ  = Refill::where( 'status', '!=', 0 )->orderByDesc( 'created_at' )->paginate( 30 );
        $total = Refill::where( 'status', 1 )->sum( 'amount' );
        if ( $date_take == null )
        {
            $total_a = Refill::where( 'status', 1 )->sum( 'amount' );
        }
        else
        {
            $total_a = Refill::where( 'status', 1 )->where( 'updated_at', '>', $date_take )->sum( 'amount' );
        }

        return view( 'admin.refill.index', compact( 'wait', 'succ', 'total', 'total_a' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRefillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreRefillRequest $request )
    {
        $setting = Setting::where( 'id', 1 )->first();

        $setting->take_money = date( 'Y-m-d H:i:s' );
        $setting->taker      = Auth::user()->username;
        $setting->save();

        return redirect()->back()->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเสร็จสิ้น'] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Refill  $refill
     * @return \Illuminate\Http\Response
     */
    public function show( Refill $refill )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refill  $refill
     * @return \Illuminate\Http\Response
     */
    public function edit( Refill $refill )
    {
        return view( 'admin.refill.edit', compact( 'refill' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRefillRequest  $request
     * @param  \App\Models\Refill  $refill
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateRefillRequest $request, Refill $refill )
    {
        if ( $request->status == 1 )
        {
            User::where( 'id', $refill->uid )->update( ['money' => DB::raw( 'money + ' . $refill->amount ), 'bonus' => DB::raw( 'bonus + ' . ( $refill->amount * 0.05 ) )] );
            $data = [
                'message'          => 'อนุมัติรายการ ' . base64_encode( $refill->id ) . ' โดย ' . Auth::user()->username . ' เรียบร้อยแล้ว',
                'stickerId'        => 51626501,
                'stickerPackageId' => 11538,
            ];

            // line_alert( $data, '6uHF35IsKVqLwszYUphFZE480ESLj9POLZxE1iIoyUX' );
            line_alert( $data );
        }
        elseif ( $request->status == 2 )
        {
            $data = [
                'message'          => 'ปฏิเสธรายการ ' . base64_encode( $refill->id ) . ' โดย ' . Auth::user()->username . ' เรียบร้อยแล้ว',
                'stickerId'        => 51626526,
                'stickerPackageId' => 11538,
            ];

            // line_alert( $data, '6uHF35IsKVqLwszYUphFZE480ESLj9POLZxE1iIoyUX' );
            line_alert( $data );
        }
        $refill->status = $request->status;
        $refill->save();

        return redirect( route( 'refill.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเสร็จสิ้น'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Refill  $refill
     * @return \Illuminate\Http\Response
     */
    public function destroy( Refill $refill )
    {
        //
    }
}