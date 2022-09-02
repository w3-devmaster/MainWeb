<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'itemshops', function ( Blueprint $table )
        {
            $table->id();
            $table->integer( 'category' );
            $table->string( 'item', 5 );
            $table->integer( 'amount' )->default( 1 );
            $table->float( 'price' )->default( 0 );
            $table->boolean( 'discount' )->default( 0 );
            $table->float( 'dis_per' )->default( 0 );
            $table->boolean( 'active' )->default( 0 );
            $table->integer( 'view' )->default( 0 );
            $table->integer( 'sold' )->default( 0 );
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
        Schema::dropIfExists( 'itemshops' );
    }
}
