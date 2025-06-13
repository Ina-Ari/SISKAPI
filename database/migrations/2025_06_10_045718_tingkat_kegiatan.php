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
        Schema::create('tingkat_kegiatan', function (Blueprint $table) {
            $table->increments('idtingkat_kegiatan');
            $table->string('tingkat_kegiatan', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('tingkat_kegiatan');
    }
};
