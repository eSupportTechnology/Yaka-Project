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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adsId');
            $table->string('condition')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('manufacture_year');
            $table->string('engine_capacity')->nullable();
            $table->string('gears_up')->nullable();
            $table->string('fragment_type')->nullable();
            $table->string('Mileage')->nullable();
            $table->timestamps();
            $table->string('edition')->nullable();
            $table->string('model_year')->nullable();
            $table->string('fuel_Type')->nullable();
            $table->string('transmission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
