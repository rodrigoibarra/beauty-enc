<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function($table){
            $table->string('status')->default('00');
        });

        Schema::table('products', function ($table) {
            $table->dropColumn('mass');
        });

        Schema::table('products', function($table){
            $table->string('mass');
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
