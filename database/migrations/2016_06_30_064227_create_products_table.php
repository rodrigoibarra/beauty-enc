<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table)
        {

            $table->increments('id');

            $table->integer('family_id')->unsigned()->index();
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->integer('brand_id')->unsigned()->index();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('currency');
            $table->string('mesurement_unit');
            $table->string('origin');
            $table->string('external_id_type');
            $table->string('provenance');
            $table->string('labeling_contry');
            $table->string('vendor_code', 100);
            $table->string('supplier', 100);
            $table->string('sku_vendor', 100);
            $table->boolean('variation')->default(False);
            $table->string('variation_type', 100);
            $table->string('item_name', 200);
            $table->string('sku', 200);
            $table->float('cost_per_unit');
            $table->float('mesurement_unit_n');
            $table->boolean('included_expiration_date')->default(False);
            $table->integer('life_span');
            $table->float('recomended_retail_price');
            $table->string('external_id', 100);
            $table->float('width');
            $table->float('height');
            $table->float('length');
            $table->float('weight');
            $table->float('package_width');
            $table->float('package_height');
            $table->float('package_length');
            $table->boolean('mass')->default(False);
            $table->text('short_description');
            $table->text('feature_1');
            $table->text('feature_2');
            $table->text('feature_3');
            $table->text('safety_warnings');
            $table->boolean('spray_gas')->default(False);
            $table->integer('number_of_parts');
            $table->integer('request_multiple');
            $table->string('image');
            $table->string('video');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
