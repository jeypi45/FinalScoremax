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
        Schema::create('footballplayers', function (Blueprint $table) {
            $table->bigIncrements('PlayerID'); // Primary key
            $table->string('FullName'); // Full name of the player
            $table->decimal('Height', 6, 2); // Height of the player in meters (e.g., 1.80)
            $table->decimal('Weight', 5, 2); // Weight of the player in kilograms (e.g., 75.5)
            $table->string('Position'); // Position of the player (e.g., Guard, Forward)
            $table->integer('Jersey_num'); // Jersey number of the player
            $table->string('TeamName')->nullable();
            $table->unsignedBigInteger('TeamID'); // Foreign key to basketballteams table
            $table->foreign('TeamID')->references('TeamID')->on('footballteams')->cascadeOnDelete(); // Cascade on delete
            $table->unsignedBigInteger('LeagueID')->nullable();
$table->foreign('LeagueID')->references('LeagueID')->on('leagues')->cascadeOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Foreign key for users
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footballplayers');
    }
};
