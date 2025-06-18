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
    Schema::table('tentang', function (Blueprint $table) {
        $table->string('gambar_profil_2')->nullable()->after('gambar_profil');
        $table->string('gambar_visimisi_2')->nullable()->after('gambar_visimisi');
    });
}

public function down(): void
{
    Schema::table('tentang', function (Blueprint $table) {
        $table->dropColumn(['gambar_profil_2', 'gambar_visimisi_2']);
    });
}

};
