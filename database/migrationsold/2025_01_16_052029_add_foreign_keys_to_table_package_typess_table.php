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
        Schema::table('table_package_typess', function (Blueprint $table) {
            $table->foreign(['package_id'])->references(['id'])->on('table_package')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_package_typess', function (Blueprint $table) {
            $table->dropForeign('table_package_typess_package_id_foreign');
        });
    }
};
