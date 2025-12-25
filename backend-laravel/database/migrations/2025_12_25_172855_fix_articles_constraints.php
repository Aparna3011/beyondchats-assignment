<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // 1️⃣ Remove UNIQUE constraint from slug
            $table->dropUnique(['slug']);

            // 2️⃣ Change enum to string (allow ai_enriched)
            $table->string('version')->change();

            // 3️⃣ Add composite unique index
            $table->unique(['slug', 'version']);
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropUnique(['slug', 'version']);
            $table->enum('version', ['original', 'updated'])->change();
            $table->string('slug')->unique();
        });
    }
};
