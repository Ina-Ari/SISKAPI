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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('id_poin');
            $table->string('nama_kegiatan', 200);
            $table->date('tanggal_kegiatan');
            $table->string('sertifikat');
            $table->char('satatus_sertif');
            $table->float('akurasi');
            $table->string('status', 45);
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_poin')->references('id_poin')->on('poin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
