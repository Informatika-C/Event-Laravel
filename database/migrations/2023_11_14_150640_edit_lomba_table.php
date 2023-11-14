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
        // add column poster to lomba table after column keterangan
        Schema::table('lomba', function (Blueprint $table) {
            $table->string('poster')->after('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop column poster from lomba table
        Schema::table('lomba', function (Blueprint $table) {
            $table->dropColumn('poster');
        });
    }
};
