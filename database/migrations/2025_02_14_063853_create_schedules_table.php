<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time_from');
            $table->time('time_to');
            $table->dateTime('start_time');
            $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
            $table->foreignId('hall_id')->constrained('halls')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropForeign(['hall_id']);
            $table->dropColumn('hall_id');
        });
    }
};
