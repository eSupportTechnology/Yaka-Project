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
        Schema::dropIfExists('membership_plans');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->integer('month_count');
            $table->integer('ads_per_month');
            $table->decimal('price', 8, 2);
            $table->decimal('promotion_voucher_cost', 8, 2)->nullable();
            $table->integer('valid_month');
            $table->timestamps();
        });
    }
};
