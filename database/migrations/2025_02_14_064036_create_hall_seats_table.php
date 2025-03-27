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
            $table->string('row'); 
            $table->foreignId('hall_id')->constrained('halls'); 
            $table->foreignId('seat_id')->constrained('seats'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hall_seats');
    }
};