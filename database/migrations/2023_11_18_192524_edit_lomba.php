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
        Schema::table('lomba', function (Blueprint $table) {
            $table->integer('max_anggota')->default(1)->after('nama_lomba');
            $table->integer('biaya_registrasi')->default(0)->after('max_anggota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lomba', function (Blueprint $table) {
            $table->dropColumn('max_anggota');
            $table->dropColumn('biaya_registrasi');
        });
    }
};
