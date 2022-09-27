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
        Schema::create('neighborhood_communities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('canton_district_id');
            $table->string('name')->nullable();
            $table->enum('type', ['BARRIO', 'COMUNIDAD']);
            $table->string('description')->nullable();
            $table->string('subgovernment_code')->nullable();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->uuid('slug')->unique();
            $table->timestamps();
            $table->foreign('canton_district_id')->references('id')->on('canton_districts')->onDedelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('neighborhood_communities');
    }
};
