<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTakeMoneyOnSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'settings', function ( Blueprint $table )
        {
            $table->dateTime( 'take_money' )->nullable();
            $table->string( 'taker' )->nullable();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'settings', function ( Blueprint $table )
        {
            $table->dropColumn( ['take_money', 'taker'] );
        } );
    }
}