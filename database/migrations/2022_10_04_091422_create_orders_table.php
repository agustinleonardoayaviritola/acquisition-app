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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('order_type_id');
            $table->unsignedBigInteger('order_code_id');
            $table->unsignedBigInteger('requesting_unit_id');
            $table->integer('application_number');
            $table->date('issue_date');
            $table->string('delivery_time');
            $table->string('observation');
            $table->decimal('total',8,2);
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDedelete('cascade');
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDedelete('cascade');
            $table->foreign('order_code_id')->references('id')->on('order_codes')->onDedelete('cascade');
            $table->foreign('requesting_unit_id')->references('id')->on('requesting_units')->onDedelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
