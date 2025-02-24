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
        Schema::create('ads', function (Blueprint $table) {
            $table->unsignedBigInteger('adsId')->primary(); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->string('url')->nullable();
            $table->unsignedBigInteger('location')->nullable();
            $table->unsignedBigInteger('sublocation')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10)->nullable();
            $table->string('mainImage')->nullable();
            $table->json('subImage')->nullable()->default(json_encode([])); 
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('sub_cat_id')->nullable();
            $table->unsignedBigInteger('ads_package')->nullable();
            $table->unsignedBigInteger('package_type')->nullable();
            $table->timestamp('package_expire_at')->nullable();
            $table->timestamp('bump_up_at')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->string('price_type')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('post_type')->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
