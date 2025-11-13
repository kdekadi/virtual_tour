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
       Schema::create('content_web', function (Blueprint $table) {
            $table->id('id_content_web'); 
            $table->string('nama_content_web', 200); // Saya perbesar dari 20
            $table->text('isi_content_web');
            $table->timestamp('waktu_tambah')->useCurrent();
            $table->timestamp('waktu_update')->nullable();

            // Foreign Key ke tabel users
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_webs');
    }
};
