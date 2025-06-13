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
        Schema::create('tentang', function (Blueprint $table) {
        $table->id();
        $table->string('judul'); // contoh: Tentang Kami
        $table->text('deskripsi'); // paragraf 1 (dengan bold manual di view)
        $table->text('deskripsi_lanjutan')->nullable(); // paragraf 2
        $table->string('gambar_profil')->nullable(); // gambar untuk profil
        $table->string('judul_visi')->nullable();
        $table->text('isi_visi')->nullable();
        $table->string('judul_misi')->nullable();
        $table->text('isi_misi')->nullable(); // jika perlu looping, pisahkan dengan delimiter
        $table->string('gambar_visimisi')->nullable(); // gambar di samping visi&misi
        $table->timestamps();
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tentang');
    }
};
