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
            $table->string('akreditasi_institusi', 100);
            $table->unsignedInteger('kode_prodi');
            $table->string('jenid_pendidikan', 100);
            $table->string('gelar', 100);
            $table->string('kualifikasi_kkni', 100);
            $table->string('persyaratan_penerimaan', 100);
            $table->string('bahasa_pengantar', 100);
            $table->string('lama_studi', 100);
            $table->longText('sikap');
            $table->longText('penguasaan_pengetahuan');
            $table->longText('keterampilan_umum');
            $table->longText('keterampilan_khusus');
            $table->string('institution_acc', 100);
            $table->string('study_program', 100);
            $table->string('education_type', 100);
            $table->string('degree', 100);
            $table->string('kkni_level', 100);
            $table->string('adminission_requirement', 100);
            $table->string('instruction_language', 100);
            $table->string('length_study', 100);
            $table->longText('attitudr');
            $table->longText('knowledge');
            $table->longText('general_skills');
            $table->longText('special_skills');

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
