<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'settings', function ( Blueprint $table )
        {
            $table->id();
            $table->boolean( 'login' )->default( true );
            $table->boolean( 'refill' )->default( true );
            $table->boolean( 'itemshop' )->default( true );
            $table->integer( 'exchange' )->default( 100 );
            $table->float( 'premium' )->default( 1.5 );
            $table->float( 'dis_shop' )->default( 0 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'settings' );
    }
}