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
        Schema::create('basket_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('basket_id')->nullable();
            $table->string('subgovernment_code')->nullable();
            $table->string('amount')->nullable();
            $table->uuid('slug')->unique();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->foreign('product_id')->references('id')->on('products')->onDedelete('cascade');
            $table->foreign('basket_id')->references('id')->on('baskets')->onDedelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDedelete('cascade');
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
        Schema::dropIfExists('basket_products');
    }
};
