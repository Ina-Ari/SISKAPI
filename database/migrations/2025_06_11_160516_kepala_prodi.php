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
        Schema::create('kepala_prodi', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->char('nip', 18);
            $table->char('nidn', 10);
            $table->string('angkatan', 5);
            $table->string('telepon', 20)->nullable();
            $table->unsignedInteger('kode_prodi');
            $table->tinyInteger('is_active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_prodi');
    }
};
