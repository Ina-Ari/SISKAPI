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
        Schema::create('prodi', function (Blueprint $table) {
            $table->increments('kode_prodi');
            $table->unsignedInteger('kode_jurusan');
            $table->string('nama_prodi', 200);
            $table->string('jenjang', 20);
            $table->timestamps();

            $table->foreign('kode_jurusan')->references('kode_jurusan')->on('jurusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
