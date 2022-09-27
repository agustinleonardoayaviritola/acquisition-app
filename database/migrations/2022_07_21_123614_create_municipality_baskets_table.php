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
        Schema::create('municipality_baskets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            //$table->unsignedBigInteger('basket_management_id')->nullable();
            $table->unsignedBigInteger('subgovernment_id')->nullable();
            $table->string('name')->nullable();
            $table->string('management')->nullable();
            $table->string('description')->nullable();
            $table->string('subgovernment_code')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('number_baskets')->nullable();
            $table->integer('number_baskets_total')->nullable();
            $table->integer('number_baskets_delivered')->nullable();
            $table->enum('state',['ACTIVE','INACTIVE','DELETED'])->default('ACTIVE');
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDedelete('cascade');
            //$table->foreign('basket_management_id')->references('id')->on('basket_management')->onDedelete('cascade');
            $table->foreign('subgovernment_id')->references('id')->on('subgovernments')->onDedelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipality_baskets');
    }
};
