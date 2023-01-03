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
        Schema::create('review_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_review_id');
            $table->index('product_review_id');
            $table->foreign('product_review_id')->references('id')->on('product_reviews');

            $table->unsignedBigInteger('image_id');
            $table->index('image_id');
            $table->foreign('image_id')->references('id')->on('images');

            $table->unique(array('product_review_id', 'image_id'));

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
            Schema::table('review_images', function (Blueprint $table) {
                $table->dropForeign(['product_review_id']);
                $table->dropForeign(['image_id']);
            });
        }
        Schema::dropIfExists('review_images');
    }
};
