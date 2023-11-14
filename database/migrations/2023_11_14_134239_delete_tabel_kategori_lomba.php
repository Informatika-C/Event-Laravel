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
        // delete event_lomba_kategori_lomba
        Schema::dropIfExists('event_lomba_kategori_lomba');
        // delete tabel kategori_lomba
        Schema::dropIfExists('kategori_lomba');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // create tabel kategori_lomba
        Schema::create('kategori_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });

        //create event_lomba_kategori_lomba
        Schema::create('event_lomba_kategori_lomba', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_lomba_id');
            $table->unsignedBigInteger('kategori_lomba_id');
            $table->timestamps();
            $table->foreign('event_lomba_id')->references('id')->on('event_lomba')->onDelete('cascade');
            $table->foreign('kategori_lomba_id')->references('id')->on('kategori_lomba')->onDelete('cascade');
        });
    }
};
