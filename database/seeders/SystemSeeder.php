<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = DB::connection( 'user' )->table( 'tbl_StaffAccount' )->get();

        $user = DB::connection( 'user' )->table( 'tbl_rfaccount' )->get();

        foreach ( $admin as $key => $value )
        {
            if ( !User::where( 'username', 1 )->exists() )
            {
                User::create( [
                    'username' => trim( $value->ID ),
                    'password' => Hash::make( trim( $value->PW ) ),
                    'email'    => substr( $value->ID, 1 ) . '@aaa.aaa',
                    'type'     => 100,
                ] );
            }
            DB::connection( 'web' )->statement( 'exec WEB_Add_Billing @username = ? ', [trim( $value->ID )] );
        }

        foreach ( $user as $key => $value )
        {
            if ( !User::where( 'username', 1 )->exists() )
            {
                User::create( [
                    'username' => trim( $value->id ),
                    'password' => Hash::make( trim( $value->password ) ),
                    'email'    => trim( $value->Email ),
                    'type'     => 0,
                ] );
            }
            DB::connection( 'web' )->statement( 'exec WEB_Add_Billing @username = ? ', [trim( $value->id )] );
        }

        Storage::deleteDirectory( 'public/gallery' );

    }
}