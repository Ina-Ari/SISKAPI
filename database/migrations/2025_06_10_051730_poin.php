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
        Schema::create('poin', function (Blueprint $table) {
            $table->increments('id_poin');
            $table->unsignedInteger('id_posisi');
            $table->unsignedInteger('idjenis_kegiatan');
            $table->unsignedInteger('idtingkat_kegiatan');

            $table->foreign('id_posisi')->references('id_posisi')->on('posisi')->onDelete('cascade');
            $table->foreign('idjenis_kegiatan')->references('idjenis_kegiatan')->on('jenis_kegiatan')->onDelete('cascade');
            $table->foreign('idtingkat_kegiatan')->references('idtingkat_kegiatan')->on('tingkat_kegiatan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poin');
    }
};
