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
        Schema::create('membership_ad_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_package_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('year');
            $table->integer('month');
            $table->integer('ads_used')->default(0);
            $table->timestamps();

            $table->foreign('membership_package_id')->references('id')->on('membership_packages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_ad_usages');
    }
};
