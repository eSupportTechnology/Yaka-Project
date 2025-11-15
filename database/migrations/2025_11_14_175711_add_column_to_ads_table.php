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
        Schema::table('ads', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->integer('bed_room')->nullable();
            $table->integer('bath_room')->nullable();
            $table->string('house_size')->nullable();
            $table->string('land_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn(['address', 'bed_room', 'bath_room', 'house_size', 'land_size']);
        });
    }
};
