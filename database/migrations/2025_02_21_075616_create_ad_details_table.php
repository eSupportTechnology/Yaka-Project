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
        Schema::create('ad_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adsId')->nullable(); 
            $table->string('additional_info');
            $table->string('value');
            $table->timestamps();
        
            $table->foreign('adsId')->references('adsId')->on('ads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_details');
    }
};
