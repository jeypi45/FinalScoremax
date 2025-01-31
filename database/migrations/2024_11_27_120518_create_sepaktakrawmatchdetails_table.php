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
        Schema::create('sepaktakrawmatchdetails', function (Blueprint $table) {
            $table->bigIncrements('MatchDetailID'); // Primary key
            $table->integer('Kills'); // Points scored by the player
            $table->integer('Aces'); // Number of assists
            $table->integer('Digs'); // Number of rebounds
            $table->integer('Blocks'); // Number of blocks
            $table->integer('Service_Errors'); // Number of fouls
            $table->unsignedBigInteger('TeamID'); // Foreign key to basketballteams table
            $table->unsignedBigInteger('PlayerID'); // Foreign key to basketballplayers table
            $table->unsignedBigInteger('LeagueID')->nullable();
$table->foreign('LeagueID')->references('LeagueID')->on('leagues')->cascadeOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Define foreign key relationships
            $table->foreign('TeamID')->references('TeamID')->on('sepaktakrawteams')->cascadeOnDelete();
            $table->foreign('PlayerID')->references('PlayerID')->on('sepaktakrawplayers')->cascadeOnDelete();

            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepaktakrawmatchdetails');
    }
};
