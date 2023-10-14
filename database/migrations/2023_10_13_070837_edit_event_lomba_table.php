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
        Schema::table('event_lomba', function (Blueprint $table) {
            $table->unsignedBigInteger('penyelenggara_id')->after('kuota');
            $table->foreign('penyelenggara_id')->references('id')->on('penyelenggara')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_lomba', function (Blueprint $table) {
            $table->dropForeign('event_lomba_id_penyelenggara_foreign');
            $table->dropColumn('id_penyelenggara');
        });
    }
};
