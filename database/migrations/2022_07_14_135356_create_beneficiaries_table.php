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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('neighborhood_community_id')->nullable();
            $table->unsignedBigInteger('beneficiary_state_id')->nullable();
            $table->uuid('slug')->unique();
            $table->string('photo')->nullable();
            $table->string('file')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('subgovernment_code')->nullable();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDedelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDedelete('cascade');
            $table->foreign('profession_id')->references('id')->on('professions')->onDedelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDedelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDedelete('cascade');
            $table->foreign('neighborhood_community_id')->references('id')->on('neighborhood_communities')->onDedelete('cascade');
            $table->foreign('beneficiary_state_id')->references('id')->on('beneficiary_states')->onDedelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
};
