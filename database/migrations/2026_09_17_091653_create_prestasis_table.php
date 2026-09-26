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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->string('nama_prestasi', 100);
            $table->text('deskripsi');
            $table->string('foto', 255)->nullable();
            $table->string('tahun_ajaran', 4);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
