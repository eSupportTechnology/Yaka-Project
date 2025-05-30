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
            $table->integer('rotation_position')->default(0)->after('status');
            $table->timestamp('last_rotated_at')->nullable()->after('rotation_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumnIfExists('rotation_position');
            $table->dropColumnIfExists('last_rotated_at');
        });
    }
};
