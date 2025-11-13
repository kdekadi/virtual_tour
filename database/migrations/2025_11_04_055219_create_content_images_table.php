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
        Schema::create('content_image', function (Blueprint $table) {
            $table->id('id_content_image'); 

            // Foreign Key ke tabel content_web
            $table->unsignedBigInteger('id_content_web');
            $table->foreign('id_content_web')->references('id_content_web')->on('content_web')->onDelete('cascade');

            $table->string('image_path', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_images');
    }
};
