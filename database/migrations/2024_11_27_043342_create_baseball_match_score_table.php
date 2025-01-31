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
        Schema::create('baseball_match_score', function (Blueprint $table) {
            $table->bigIncrements('MatchID');
            $table->unsignedBigInteger('LeagueID')->nullable();
$table->foreign('LeagueID')->references('LeagueID')->on('leagues')->cascadeOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('Team1Name', 255)->nullable(); // Equivalent to varchar(255) DEFAULT NULL
            $table->string('Team2Name', 255)->nullable(); // Equivalent to varchar(255) DEFAULT NULL
            $table->integer('Team1Score')->nullable(); // Equivalent to int(11) DEFAULT NULL
            $table->integer('Team2Score')->nullable(); // Equivalent to int(11) DEFAULT NULL
            $table->string('Game_Winner', 255)->nullable(); // Equivalent to varchar(255) DEFAULT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baseball_match_score');
    }
};
