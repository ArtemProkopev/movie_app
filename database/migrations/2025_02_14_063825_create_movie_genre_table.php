<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movie_genre', function (Blueprint $table) {
            $table->foreignId('movie_id')->constrained('movies');
            $table->foreignId('genre_id')->constrained('genres');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_genre');
    }
};
