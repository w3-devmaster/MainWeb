<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserManageRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate( 35 );

        return view( 'admin.users.index', compact( 'users' ) );
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
    public function store( Request $request )
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( User $user )
    {

        $ac = getUserData( $user->username );

        if ( array_key_exists( 'account', $ac ) )
        {
            $game = getGameData( $ac );
        }
        else
        {
            $game = getGameData( $ac, $user->username );
        }

        return view( 'admin.users.show', compact( 'user', 'ac', 'game' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user )
    {
        return view( 'admin.users.edit', compact( 'user' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateUserManageRequest $request, User $user )
    {
        $user->money = $request->money;
        $user->save();

        return redirect( route( 'users.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'บันทึกข้อมูลเสร็จสิ้น'] );
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