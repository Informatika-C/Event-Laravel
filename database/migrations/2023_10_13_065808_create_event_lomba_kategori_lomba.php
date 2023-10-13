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
        Schema::create('event_lomba_kategori_lomba', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_event_lomba');
            $table->unsignedBigInteger('id_kategori_lomba');
            $table->timestamps();
            $table->foreign('id_event_lomba')->references('id')->on('event_lomba')->onDelete('cascade');
            $table->foreign('id_kategori_lomba')->references('id')->on('kategori_lomba')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_lomba_kategori_lomba');
    }
};
