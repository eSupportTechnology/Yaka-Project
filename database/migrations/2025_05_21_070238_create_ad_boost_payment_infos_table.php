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
         Schema::create('ad_boost_payment_infos', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_id')->unique();
        $table->string('check_value')->nullable(); 
        $table->unsignedBigInteger('ads_id');
        $table->unsignedBigInteger('user_id');
        $table->integer('payment_status')->default(0); // 0-Pending, 1-Succes
        $table->timestamps();

     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_boost_payment_infos');
    }
};
