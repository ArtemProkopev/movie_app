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
        if (Schema::hasColumn('movies', 'genre_id')) {
            Schema::table('movies', function (Blueprint $table) {
                $table->dropColumn('genre_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    if (!Schema::hasColumn('movies', 'genre_id')) {
        Schema::table('movies', function (Blueprint $table) {
            $table->foreignId('genre_id')
                ->nullable()
                ->default(1)
                ->constrained('genres')
                ->onDelete('cascade');
        });
    }
}
};