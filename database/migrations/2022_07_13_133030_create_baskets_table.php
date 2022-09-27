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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->uuid('code')->unique();
            $table->string('description')->nullable();
            $table->decimal('price_amount', 8,2)->nullable();
            $table->string('name')->nullable();
            $table->uuid('slug')->unique();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->string('subgovernment_code')->nullable();
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
        Schema::dropIfExists('baskets');
    }
};
