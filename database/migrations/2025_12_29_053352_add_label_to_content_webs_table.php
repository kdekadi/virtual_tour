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
    Schema::table('content_web', function (Blueprint $table) {
        // Menambahkan kolom label
        $table->string('label')->nullable()->after('nama_content_web');
    });
}

public function down(): void
{
    Schema::table('content_web', function (Blueprint $table) {
        $table->dropColumn('label');
    });
}
};
