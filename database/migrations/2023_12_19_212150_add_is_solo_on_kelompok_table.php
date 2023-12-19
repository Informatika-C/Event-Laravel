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
        // add is_solo column on kelompok table
        Schema::table('kelompok', function (Blueprint $table) {
            $table->boolean('is_solo')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop is_solo column on kelompok table
        Schema::table('kelompok', function (Blueprint $table) {
            $table->dropColumn('is_solo');
        });
    }
};
