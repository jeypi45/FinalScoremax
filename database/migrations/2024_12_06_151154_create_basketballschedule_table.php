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
        Schema::create('basketballschedule', function (Blueprint $table) {
            $table->bigIncrements('SchedID');
            $table->unsignedBigInteger('LeagueID')->nullable();
            $table->foreign('LeagueID')->references('LeagueID')->on('leagues')->cascadeOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('Team1Name', 255)->nullable();
            $table->string('Team2Name', 255)->nullable();

            $table->string('Game_Winner', 255)->nullable();
            
            // Adding the match date and match time
            $table->date('match_date')->nullable(); // Match date in YYYY-MM-DD format
            $table->time('match_time')->nullable(); // Match time in HH:MM:SS format
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basketballschedule');
    }
};
