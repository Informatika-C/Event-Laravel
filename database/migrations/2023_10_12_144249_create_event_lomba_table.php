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
        Schema::create('event_lomba', function (Blueprint $table) {
            $table->id();
            $table->char('nama_lomba', 100);
            $table->string('deskripsi');
            $table->char('tempat', 100);
            $table->date('tanggal_pendaftaran');
            $table->date('tanggal_penutupan_pendaftaran');
            $table->date('tanggal_pelaksanaan');
            $table->integer('kuota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_lomba');
    }
};
