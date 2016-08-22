<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetailerFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retailer_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('retailer_retailer_field', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('retailer_id')->unsigned()->index();
            $table->foreign('retailer_id')->references('id')->on('retailers')->onDelete('cascade');
            $table->integer('retialer_field_id')->unsigned()->index();
            $table->foreign('retialer_field_id')->references('id')->on('retailer_fields')->onDelete('cascade');
        });

        Schema::create('product_retailer', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('retailer_id')->unsigned()->index();
            $table->foreign('retailer_id')->references('id')->on('retailers')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('retailer_fields');
        Schema::drop('product_retailer');
    }
}
