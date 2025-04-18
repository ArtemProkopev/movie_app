<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hall_seats', function (Blueprint $table) {
            $table->id();
            $table->string('seat_number');
            // $table->foreignId('seat_id')->constrained();
            $table->string('row');
            $table->decimal('price', 8, 2);
            $table->foreignId('hall_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hall_seats');
    }
};