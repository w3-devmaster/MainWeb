<?php

namespace App\Http\Controllers;

use App\Http\Requests\GMStoreRequest;
use App\Http\Requests\GMUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gm = User::where( 'type', 100 )->paginate( 20 );

        return view( 'admin.gm.index', compact( 'gm' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.gm.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( GMStoreRequest $request )
    {
        if ( User::where( 'username', $request->username )->exists() )
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'ไอดีที่เลือกได้ถูกใช้งานไปแล้ว'] );
        }

        if ( User::where( 'email', $request->email )->exists() )
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'อีเมลที่เลือกได้ถูกใช้งานไปแล้ว'] );
        }

        User::create( [
            'username' => $request->username,
            'password' => Hash::make( $request->password ),
            'email'    => $request->email,
            'type'     => 100,
        ] );

        $add = DB::connection( 'web' )->statement( 'exec WEB_Register_User
        @username = ?,
        @password = ?,
        @email = ?,
        @type = ?
    ',
            [
                $request->username,
                $request->password,
                '',
                1,
            ]
        );

        if ( $add )
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'success', 'msg' => 'เพิ่มไอดีเสร็จสิ้น'] );
        }
        else
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'เพิ่มไอดีผิดพลาด'] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( User $user )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update( GMUpdateRequest $request, User $user )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user )
    {
        //
    }
}