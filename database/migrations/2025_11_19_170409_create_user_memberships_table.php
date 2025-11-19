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
        Schema::create('user_memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('valid_month');
            $table->decimal('price', 10, 2);
            $table->integer('ads_per_month');
            $table->decimal('promotion_voucher_cost', 10, 2);
            $table->date('start_date');
            $table->date('expiry_date');
            $table->string('voucher_code', 50)->unique();
            $table->string('business_name');
            $table->string('business_email');
            $table->string('business_phone');
            $table->string('order_id')->unique();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'expiry_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_memberships');
    }
};
