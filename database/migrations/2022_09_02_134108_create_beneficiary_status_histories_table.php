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
        Schema::create('beneficiary_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('beneficiary_id')->nullable();
            $table->unsignedBigInteger('beneficiary_state_detail_id');
            $table->string('description')->nullable();
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('beneficiary_state_detail_id')->references('id')->on('beneficiary_state_details')->onDedelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDedelete('cascade');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onDedelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_status_histories');
    }
};
