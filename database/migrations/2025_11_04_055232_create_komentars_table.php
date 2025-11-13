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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id('id_komentar'); // Sesuai ERD
            $table->string('isi_komentar', 255);
            $table->dateTime('waktu_komentar');

            // Foreign Key ke tabel users
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users');

            // Untuk nested comment (balasan)
            $table->unsignedBigInteger('parent_id')->nullable(); 
            $table->foreign('parent_id')->references('id_komentar')->on('komentar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
