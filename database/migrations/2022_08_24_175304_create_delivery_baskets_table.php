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
        Schema::create('delivery_baskets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->unsignedBigInteger('beneficiary_id')->nullable();
            $table->unsignedBigInteger('delivery_point_id')->nullable();
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->date('date_delivery')->nullable();
            $table->string('subgovernment_code')->nullable();
            $table->uuid('slug')->unique();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->enum('state_delivery', ['ENTREGADO', 'RETENIDO'])->default('ENTREGADO');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDedelete('cascade');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onDedelete('cascade');
            $table->foreign('delivery_point_id')->references('id')->on('delivery_points')->onDedelete('cascade');
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDedelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDedelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_baskets');
    }
};
