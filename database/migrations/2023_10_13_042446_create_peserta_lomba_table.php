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
        Schema::create('peserta_lomba', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lomba');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
            $table->foreign('id_lomba')->references('id')->on('event_lomba')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_lomba');
    }
};
