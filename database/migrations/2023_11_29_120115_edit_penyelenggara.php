<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // add logo in penyelenggara
    public function up(): void
    {
        Schema::table('penyelenggara', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('nama_penyelenggara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // remove column
        Schema::table('penyelenggara', function (Blueprint $table) {
            $table->dropColumn('logo');
        });
    }
};
