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
        //delete column kuota in table event_lomba
        Schema::table('event_lomba', function (Blueprint $table) {
            $table->dropColumn('kuota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //add column kuota in table event_lomba
        Schema::table('event_lomba', function (Blueprint $table) {
            $table->integer('kuota');
        });
    }
};
