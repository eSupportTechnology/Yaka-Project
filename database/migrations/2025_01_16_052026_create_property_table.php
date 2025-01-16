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
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adsId');
            $table->string('condition')->nullable();
            $table->string('brand')->nullable();
            $table->string('size_of_land')->nullable();
            $table->string('size_sf')->nullable();
            $table->string('unit')->nullable();
            $table->string('address')->nullable();
            $table->string('rooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->timestamps();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property');
    }
};
