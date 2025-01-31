<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name');   // The name field
            $table->string('message'); // The message field
            $table->unsignedBigInteger('team_id')->nullable(); // Foreign key for the team
            $table->string('team_name'); // To store the TeamName
            $table->unsignedBigInteger('league_id')->nullable();
            $table->string('team_type'); // To identify the team type (basketball, volleyball, etc.)
            $table->timestamps();

            $table->foreign('league_id')
            ->references('LeagueID')->on('leagues')
            ->onDelete('set null'); // Or 'cascade' based on your needs
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
