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
        Schema::dropIfExists('ads_limitations');
    }

    public function down(): void
    {
        // Optionally recreate the table if rolled back
        Schema::create('ads_limitations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('limit');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }
};
