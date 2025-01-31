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
        Schema::create('basketball_brackets', function (Blueprint $table) {
            $table->id('MatchID');  // Primary key for basketball_matches table
            $table->unsignedBigInteger('Team1ID')->nullable();  // First team ID
            $table->unsignedBigInteger('Team2ID')->nullable();  // Second team ID
            $table->unsignedBigInteger('WinnerID')->nullable();  // Winning team ID
            $table->integer('Round');  // Round number
            $table->unsignedBigInteger('LeagueID')->nullable();
$table->foreign('LeagueID')->references('LeagueID')->on('leagues')->cascadeOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();  // User who created the match

            // Foreign key for Team1ID
            $table->foreign('Team1ID')
                ->references('TeamID')  // Reference TeamID in basketballteams
                ->on('basketballteams')
                ->onDelete('cascade');  // Cascade delete if the team is deleted

            // Foreign key for Team2ID
            $table->foreign('Team2ID')
                ->references('TeamID')  // Reference TeamID in basketballteams
                ->on('basketballteams')
                ->onDelete('cascade');  // Cascade delete if the team is deleted

            // Foreign key for WinnerID
            $table->foreign('WinnerID')
                ->references('TeamID')  // Reference TeamID in basketballteams
                ->on('basketballteams')
                ->onDelete('set null');  // Set winner to null if the team is deleted

            // Foreign key for user_id
            $table->foreign('user_id')
                ->references('id')  // Reference id in users table
                ->on('users')
                ->onDelete('cascade');  // Cascade delete if the user is deleted

            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basketball_brackets');
    }
};
