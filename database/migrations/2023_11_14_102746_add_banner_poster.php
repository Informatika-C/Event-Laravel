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
        // add banner and poster column in event_lomba table after kouta column
        Schema::table('event_lomba', function (Blueprint $table) {
            $table->string('banner')->after('kuota')->nullable();
            $table->string('poster')->after('banner')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop banner and poster column in event_lomba table
        Schema::table('event_lomba', function (Blueprint $table) {
            $table->dropColumn('banner');
            $table->dropColumn('poster');
        });
    }
};
