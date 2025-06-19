<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('informasi_kontak', function (Blueprint $table) {
            $table->text('link_maps')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('informasi_kontak', function (Blueprint $table) {
            $table->string('link_maps', 255)->nullable()->change();
        });
    }
};
