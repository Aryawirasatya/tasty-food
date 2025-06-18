<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tentang', function (Blueprint $table) {
        $table->string('gambar_misi_1')->nullable()->after('isi_misi');
    });
}

public function down()
{
    Schema::table('tentang', function (Blueprint $table) {
        $table->dropColumn('gambar_misi_1');
    });
}

};
