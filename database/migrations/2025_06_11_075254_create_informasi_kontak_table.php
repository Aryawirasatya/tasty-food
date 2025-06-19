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
            Schema::create('informasi_kontak', function (Blueprint $table) {
        $table->id();
        $table->string('alamat');
        $table->string('email');
        $table->string('telepon');
        $table->string('link_maps')->nullable();
        $table->string('url_email')->nullable(); // mailto: atau link tujuan email
        $table->string('url_telepon')->nullable(); // tel: atau WA link
        $table->string('url_alamat')->nullable(); // link ke lokasi
        $table->timestamps();
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_kontak');
    }
};
