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
        Schema::create('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('adsId');
            $table->string('job_type')->nullable();
            $table->string('role')->nullable();
            $table->string('education')->nullable();
            $table->string('application_deadline')->nullable();
            $table->string('experience')->nullable();
            $table->string('cv_sent_email')->nullable();
            $table->string('salary_per_month')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
