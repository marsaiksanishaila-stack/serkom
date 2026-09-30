<?php 
 
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema; 
 
return new class extends Migration 
{ 
    public function up(): void 
    { 
        Schema::create('beritas', function (Blueprint $table) { 
            $table->id('id_berita'); 
            $table->string('judul', 100); 
            $table->text('isi'); 
            $table->date('tanggal'); 
            $table->string('foto')->nullable(); 
            $table->enum('status', ['Draft', 'Public'])->default('Draft'); 
            $table->unsignedBigInteger('id_user'); 
 
            $table->foreign('id_user') 
                  ->references('id_user') 
                  ->on('users') 
                  ->onDelete('cascade'); 
 
            $table->timestamps(); 
        }); 
    } 
 
    public function down(): void 
    { 
        Schema::dropIfExists('beritas'); 
    } 
}; 
