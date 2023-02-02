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
            $table->unsignedBigInteger('supplier_id'); //proveedor
            $table->unsignedBigInteger('order_type_id'); //tipo de orden
            $table->unsignedBigInteger('order_code_id'); // tipo de codigo
            $table->string('code')->nullable();
            $table->unsignedBigInteger('requesting_unit_id'); //unidad solicitante
            $table->unsignedBigInteger('user_id'); //usuario
            $table->integer('application_number')->nullable();
            $table->date('issue_date')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('observation')->nullable();
            $table->decimal('total',8,2)->nullable();
            $table->enum('state', ['PENDIENTE', 'ENTREGADO', 'ELIMINADO'])->default('PENDIENTE');
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDedelete('cascade');
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDedelete('cascade');
            $table->foreign('order_code_id')->references('id')->on('order_codes')->onDedelete('cascade');
            $table->foreign('requesting_unit_id')->references('id')->on('requesting_units')->onDedelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
