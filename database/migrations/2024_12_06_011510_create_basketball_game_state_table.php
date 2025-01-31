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
        Schema::create('basketball_game_state', function (Blueprint $table) {
            $table->id();
            $table->integer('league_id'); // if you have a league ID for association
            $table->integer('team_a_id')->nullable();
            $table->integer('team_b_id')->nullable();
            $table->integer('score_a')->default(0);
            $table->integer('score_b')->default(0);
            $table->integer('timer')->default(720); // default 12 minutes
            $table->integer('period')->default(1);
            $table->json('players_a')->nullable();
            $table->json('players_b')->nullable();
            $table->integer('timeouts_a')->default(3);
            $table->integer('timeouts_b')->default(3);
            $table->string('mvp')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basketball_game_state');
    }
};
