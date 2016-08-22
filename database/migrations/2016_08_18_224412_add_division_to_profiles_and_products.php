<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDivisionToProfilesAndProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('profiles', function($table){
            $table->integer('division_id')->unsigned()->index()->nullable();
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
        });

        Schema::table('products', function($table){
            $table->integer('division_id')->unsigned()->index()->nullable();
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
