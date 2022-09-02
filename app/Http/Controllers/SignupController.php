<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupStoreRequest;
use App\Http\Requests\SignupUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\SignupStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( SignupStoreRequest $request )
    {

        if ( $request->password === $request->password_confirmation )
        {
            $request->merge( [
                'username'      => strtolower( $request->username ),
                'password_true' => $request->password,
                'password'      => Hash::make( $request->password ),
            ] );

            if ( !User::where( 'username', $request->username )->exists() )
            {
                if ( !User::where( 'email', $request->email )->exists() )
                {
                    $user     = User::create( $request->all() );
                    $add_user = DB::connection( 'web' )->statement( 'exec WEB_Register_User
                        @username = ?,
                        @password = ?,
                        @email = ?,
                        @type = ?
                    ',
                        [
                            $request->username,
                            $request->password_true,
                            $request->email,
                            0,
                        ]
                    );

                    if ( $add_user )
                    {
                        return redirect()->back()->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการลงทะเบียนเสร็จสิ้น'] );
                    }
                    else
                    {
                        return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'เกิดปัญหาบางอย่าง กรุณาติดต่อเจ้าหน้าที่'] );
                    }
                }
                else
                {
                    return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'มีผู้ใช้อีเมลนี้ในระบบแล้ว'] );
                }
            }
            else
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'บัญชีผู้ใช้นี้มีอยู่ในระบบแล้ว'] );
            }
        }
        else
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รหัสผ่านทั้งสองช่องไม่ตรงกัน'] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  User $signup
     * @return \Illuminate\Http\Response
     */
    public function show( User $signup )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $signup
     * @return \Illuminate\Http\Response
     */
    public function edit( User $signup )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SignupStoreRequest  $request
     * @param  User $signup
     * @return \Illuminate\Http\Response
     */
    public function update( SignupUpdateRequest $request, User $signup )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $signup
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $signup )
    {
        //
    }
}