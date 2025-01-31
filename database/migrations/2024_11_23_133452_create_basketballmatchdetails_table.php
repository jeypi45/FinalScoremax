<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basketballmatchdetails', function (Blueprint $table) {
            $table->bigIncrements('MatchDetailID'); // Primary key
            $table->integer('Points'); // Points scored by the player
            $table->integer('Assists'); // Number of assists
            $table->integer('Rebounds'); // Number of rebounds
            $table->integer('Blocks'); // Number of blocks
            $table->integer('Fouls'); // Number of fouls
            $table->unsignedBigInteger('TeamID'); // Foreign key to basketballteams table
            $table->unsignedBigInteger('PlayerID'); // Foreign key to basketballplayers table
            $table->unsignedBigInteger('LeagueID')->nullable();
$table->foreign('LeagueID')->references('LeagueID')->on('leagues')->cascadeOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Define foreign key relationships
            $table->foreign('TeamID')->references('TeamID')->on('basketballteams')->cascadeOnDelete();
            $table->foreign('PlayerID')->references('PlayerID')->on('basketballplayers')->cascadeOnDelete();

            $table->timestamps(); // Created_at and updated_at timestamps
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basketballmatchdetails');
    }
};
