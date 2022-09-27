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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->string('name')->nullable();
            $table->decimal('amount', 8,2)->nullable();
            $table->string('description')->nullable();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->string('subgovernment_code')->nullable();
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
        Schema::dropIfExists('products');
    }
};
