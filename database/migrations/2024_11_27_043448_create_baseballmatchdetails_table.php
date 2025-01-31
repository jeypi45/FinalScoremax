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
        Schema::create('baseballmatchdetails', function (Blueprint $table) {
            $table->bigIncrements('MatchDetailID'); // Primary key
            $table->integer('Runs'); // Points scored by the player
            $table->integer('Hits'); // Number of assists
            $table->integer('Home_Runs'); // Number of rebounds
            $table->integer('Strikeouts'); // Number of blocks
            $table->integer('Errors'); // Number of fouls
            $table->unsignedBigInteger('TeamID'); // Foreign key to basketballteams table
            $table->unsignedBigInteger('PlayerID'); // Foreign key to basketballplayers table
            $table->unsignedBigInteger('LeagueID')->nullable();
$table->foreign('LeagueID')->references('LeagueID')->on('leagues')->cascadeOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Define foreign key relationships
            $table->foreign('TeamID')->references('TeamID')->on('baseballteams')->cascadeOnDelete();
            $table->foreign('PlayerID')->references('PlayerID')->on('baseballplayers')->cascadeOnDelete();

            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baseballmatchdetails');
    }
};
