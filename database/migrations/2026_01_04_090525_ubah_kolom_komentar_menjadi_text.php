<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('komentar', function (Blueprint $table) {
            // Kita ubah dari string (255) ke text (65.535 karakter)
            $table->text('isi_komentar')->change();
        });
    }

    public function down(): void
    {
        Schema::table('komentar', function (Blueprint $table) {
            $table->string('isi_komentar', 255)->change();
        });
    }
};