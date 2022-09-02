<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'categories', function ( Blueprint $table )
        {
            $table->id();
            $table->integer( 'index' )->nullable();
            $table->string( 'name' );
            $table->boolean( 'discount' )->default( 0 );
            $table->float( 'dis_per' )->default( 0 );
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
        Schema::dropIfExists( 'categories' );
    }
}