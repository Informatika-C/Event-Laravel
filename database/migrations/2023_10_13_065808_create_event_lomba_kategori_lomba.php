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
            $table->unsignedBigInteger('event_lomba_id');
            $table->unsignedBigInteger('kategori_lomba_id');
            $table->timestamps();
            $table->foreign('event_lomba_id')->references('id')->on('event_lomba')->onDelete('cascade');
            $table->foreign('kategori_lomba_id')->references('id')->on('kategori_lomba')->onDelete('cascade');
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
