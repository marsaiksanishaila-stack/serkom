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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nisn', 10);
            $table->string('nama_siswa', 40);
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->year('tahun_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
