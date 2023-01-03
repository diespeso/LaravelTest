<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('image_id');
            $table->index('image_id');
            $table->foreign('image_id')->references('id')->on('images');

            $table->unsignedBigInteger('product_id');
            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->boolean('isMain');

            $table->unique(array('image_id', 'product_id'));

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
        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('product_images', function (Blueprint $table) {
                $table->dropForeign(['image_id']);
                $table->dropForeign(['product_id']);
            });
        }
        Schema::dropIfExists('product_images');
    }
};
