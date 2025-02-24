<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('electronic_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adsId')->nullable();
            $table->string('condition')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('specialization')->nullable();
            $table->string('type')->nullable();
            $table->string('screen_size')->nullable();
            $table->string('capacity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electronic_devices');
    }
};
