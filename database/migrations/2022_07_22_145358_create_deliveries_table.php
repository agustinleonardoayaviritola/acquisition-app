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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('municipality_basket_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('basket_id')->nullable();
            $table->string('description')->nullable();
            $table->string('subgovernment_code')->nullable();
            $table->string('month')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('number_baskets')->nullable();
            $table->integer('number_baskets_total')->nullable();
            $table->integer('number_baskets_delivered')->nullable();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('municipality_basket_id')->references('id')->on('municipality_baskets')->onDedelete('cascade');
            $table->foreign('basket_id')->references('id')->on('baskets')->onDedelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDedelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
