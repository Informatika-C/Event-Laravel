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
        Schema::create('lomba_kelompok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lomba_id');
            $table->unsignedBigInteger('kelompok_id');
            $table->boolean('lunas')->default(false);
            $table->timestamps();
            $table->foreign('lomba_id')->references('id')->on('lomba')->onDelete('cascade');
            $table->foreign('kelompok_id')->references('id')->on('kelompok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_kelompok');
    }
};
