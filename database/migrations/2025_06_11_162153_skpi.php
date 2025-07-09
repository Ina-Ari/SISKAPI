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
        Schema::create('skpi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('kepala_prodi_id');
            $table->string('nomor_skpi', 45);
            $table->string('nomor_ijazah', 45);
            $table->string('link', 200);
            $table->string('status', 45);
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('user_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kepala_prodi_id')->references('user_id')->on('kepala_prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpi');
    }
};
