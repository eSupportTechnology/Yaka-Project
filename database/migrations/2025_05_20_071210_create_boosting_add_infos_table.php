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
        Schema::create('boosting_add_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ad_id');
            $table->string('ad_title');
            $table->text('ad_description')->nullable();
            $table->decimal('ad_price', 10, 2);
            $table->unsignedBigInteger('current_package_id')->nullable();
            $table->string('current_package_name')->nullable();
            $table->unsignedBigInteger('current_package_type_id')->nullable();
            $table->integer('current_package_duration')->nullable(); // changed from string to integer
            $table->string('current_package_expiry')->nullable();
            $table->unsignedBigInteger('new_package_id');
            $table->string('new_package_name');
            $table->unsignedBigInteger('new_package_type_id');
            $table->integer('new_package_duration'); // changed from string to integer
            $table->decimal('amount', 10, 2);
            $table->string('payment_status')->default('pending');
            $table->timestamps();
            $table->string('invoice_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boosting_add_infos');
    }
};
