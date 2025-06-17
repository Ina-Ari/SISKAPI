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
        Schema::create('tinjauan', function (Blueprint $table) {
            $table->unsignedInteger('baak_id');
            $table->unsignedInteger('skpi_id');
            $table->text('catatan');
            $table->timestamps();

            $table->primary(['baak_id', 'skpi_id']);
            $table->foreign('baak_id')->references('user_id')->on('baak')->onDelete('cascade');
            $table->foreign('skpi_id')->references('id')->on('skpi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tinjauan');
    }
};
