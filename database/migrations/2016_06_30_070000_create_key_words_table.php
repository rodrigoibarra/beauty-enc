<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_words', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('key_word_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key_word_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('key_words');
    }
}
