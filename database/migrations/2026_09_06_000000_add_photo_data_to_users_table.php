<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->binary('photo_data')->nullable(); // Isi file foto (bytea di Postgres)
            $table->string('photo_mime')->nullable(); // Mime type foto, mis. image/png
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['photo_data', 'photo_mime']);
        });
    }
};
