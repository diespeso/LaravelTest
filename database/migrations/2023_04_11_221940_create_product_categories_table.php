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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->unsignedBigInteger('category_id');
            $table->index('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

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
            Schema::table('product_categories', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropForeign(['product_id']);
            });
        }
        Schema::dropIfExists('product_categories');
    }
};