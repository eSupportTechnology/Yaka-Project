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
        $table->unsignedInteger('experience_years')->nullable();
        $table->string('education')->nullable();
        $table->date('application_deadline')->nullable();
         $table->string('mobile_number')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
        $table->dropColumn(['experience_years', 'education', 'application_deadline', 'mobile_number']);
       });
    }
};
