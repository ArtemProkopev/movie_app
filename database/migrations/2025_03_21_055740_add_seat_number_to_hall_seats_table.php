<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('hall_seats', 'seat_number')) {
            Schema::table('hall_seats', function (Blueprint $table) {
                $table->string('seat_number')->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('hall_seats', 'seat_number')) {
            Schema::table('hall_seats', function (Blueprint $table) {
                $table->dropColumn('seat_number');
            });
        }
    }
};