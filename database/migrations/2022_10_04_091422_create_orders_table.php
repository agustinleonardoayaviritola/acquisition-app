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
            $table->string('code');
            $table->unsignedBigInteger('applicant_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('application_number');
            $table->date('issue_date');
            $table->string('delivery_time');
            $table->string('observation');
            $table->decimal('total',8,2);
            $table->enum('state', ['PENDIENTE', 'ENTREGADO', 'DELETED'])->default('PENDIENTE');
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDedelete('cascade');
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDedelete('cascade');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDedelete('cascade');
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
