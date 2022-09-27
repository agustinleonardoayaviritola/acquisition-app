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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->enum('deliveries', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->enum('records', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->enum('updates', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->uuid('slug')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
