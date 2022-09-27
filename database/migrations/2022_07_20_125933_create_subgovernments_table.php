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
        Schema::create('subgovernments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('municipality_id');
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->string('description')->nullable();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDedelete('cascade');
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
        Schema::dropIfExists('subgovernments');
    }
};
