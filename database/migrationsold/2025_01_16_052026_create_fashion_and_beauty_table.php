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
        Schema::create('fashion_and_beauty', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('adsId');
            $table->string('type')->nullable();
            $table->string('condition')->nullable();
            $table->timestamps();
            $table->string('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fashion_and_beauty');
    }
};
