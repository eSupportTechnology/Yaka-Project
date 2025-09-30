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
        Schema::table('payment_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_infos', 'check_value')) {
                $table->string('check_value')->nullable();
            } else {
                $table->string('check_value')->nullable()->change();
            }

            if (!Schema::hasColumn('payment_infos', 'ad_data')) {
                $table->longText('ad_data')->nullable();
            } else {
                $table->longText('ad_data')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_infos', function (Blueprint $table) {
            $table->string('check_value')->nullable(false)->change();
            $table->longText('ad_data')->nullable(false)->change();
        });
    }
};
