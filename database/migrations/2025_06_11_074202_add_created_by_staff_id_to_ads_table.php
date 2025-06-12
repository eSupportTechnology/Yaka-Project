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
            $table->unsignedBigInteger('created_by_staff_id')->nullable()->after('user_id');

            $table->foreign('created_by_staff_id')->references('id')->on('users')->onDelete('set null');

            $table->index('created_by_staff_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['created_by_staff_id']);
            $table->dropIndex(['created_by_staff_id']);

            $table->dropColumn('created_by_staff_id');
        });
    }
};
