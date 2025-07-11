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
        Schema::create('jenis_kegiatan', function (Blueprint $table) {
            $table->increments('idjenis_kegiatan');
            $table->string('jenis_kegiatan', 100);
            $table->string('kategori_skpi', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kegiatan');
    }
};
