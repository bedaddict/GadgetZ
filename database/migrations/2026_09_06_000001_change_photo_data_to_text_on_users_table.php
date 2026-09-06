<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE users ALTER COLUMN photo_data TYPE text');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE users ALTER COLUMN photo_data TYPE bytea USING photo_data::bytea');
    }
};
