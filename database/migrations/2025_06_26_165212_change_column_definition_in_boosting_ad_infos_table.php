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
        Schema::table('boosting_add_infos', function (Blueprint $table) {
            DB::statement("ALTER TABLE boosting_add_infos MODIFY ad_description TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boosting_add_infos', function (Blueprint $table) {
            //
        });
    }
};
