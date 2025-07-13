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
         Schema::create('form_skpi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('akreditasi_institusi', 100)->nullable();
            $table->unsignedInteger('kode_prodi')->nullable();
            $table->string('jenis_pendidikan', 100)->nullable();
            $table->string('gelar', 100)->nullable();
            $table->string('kualifikasi_kkni', 100)->nullable();
            $table->string('persyaratan_penerimaan', 100)->nullable();
            $table->string('bahasa_pengantar', 100)->nullable();
            $table->string('lama_studi', 100)->nullable();
            $table->longText('sikap')->nullable();
            $table->longText('penguasaan_pengetahuan')->nullable();
            $table->longText('keterampilan_umum')->nullable();
            $table->longText('keterampilan_khusus')->nullable();
            $table->string('institution_acc', 100)->nullable();
            $table->string('study_program', 100)->nullable();
            $table->string('education_type', 100)->nullable();
            $table->string('degree', 100)->nullable();
            $table->string('kkni_level', 100)->nullable();
            $table->string('adminission_requirement', 100)->nullable();
            $table->string('instruction_language', 100)->nullable();
            $table->string('length_study', 100)->nullable();
            $table->longText('attitude')->nullable();
            $table->longText('knowledge')->nullable();
            $table->longText('general_skills')->nullable();
            $table->longText('special_skills')->nullable();

            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_skpi');
    }
};
