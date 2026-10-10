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
        Schema::create('ekstrakurikulers', function (Blueprint $table) {
            $table->id('id_ekskul');
            $table->string('nama_ekskul', 40);
            $table->string('slug')->unique();
            $table->string('pembina', 40);
            $table->string('jadwal_latihan', 40);
            $table->text('deskripsi');
            $table->string('gambar', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikulers');
    }
};
