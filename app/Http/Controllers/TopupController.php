<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopupRequest;
use App\Models\Refill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class TopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $his = Refill::where( 'uid', Auth::user()->id )->orderByDesc( 'created_at' )->orderBy( 'status' )->get();

        return view( 'pages.topup', compact( 'his' ) );
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreTopupRequest $request )
    {

        $img        = $request->file( 'image' );
        $image_name = genImageName() . '.' . $img->extension();

        $path = $img->storeAs( 'public/topup', $image_name );

        $request->merge( [
            'img'      => $path,
            'username' => Auth::user()->username,
            'uid'      => Auth::user()->id,
        ] );

        $refill = Refill::create( $request->all() );

        $data = [
            'message' => "\r\n" . 'มีการแจ้งเติมเงิน' . "\r\n" . 'รหัสรายการ : ' . base64_encode( $refill->id ) . "\r\n" . 'จำนวน ' . $request->amount . ' บาท ' . "\r\n" . 'จากไอดี ' . Auth::user()->username . "\r\n" . ' สลิปการโอนเงิน ' . URL::to( Storage::url( $path ) ),
            // 'stickerId'        => 52002734,
            // 'stickerPackageId' => 11537,
        ];

        // line_alert( $data, '6uHF35IsKVqLwszYUphFZE480ESLj9POLZxE1iIoyUX' );
        line_alert( $data );

        return redirect( route( 'topup' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการแจ้งโอนเสร็จสิ้น กรุณารอการอนุมัติ'] );

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Refill  $refill
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Refill $refill )
    {
        //
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