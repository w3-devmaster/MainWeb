<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'refills', function ( Blueprint $table )
        {
            $table->id();
            $table->integer( 'uid' );
            $table->string( 'username' );
            $table->float( 'amount' );
            $table->tinyInteger( 'status' )->default( 0 );
            $table->string( 'img' );
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
        Schema::dropIfExists( 'refills' );
    }
}