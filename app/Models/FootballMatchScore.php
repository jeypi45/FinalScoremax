<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballMatchScore extends Model
{
    use HasFactory;

    protected $table = 'football_match_score';

    protected $fillable = [
        'user_id',
        'Team1Name',
        'Team2Name',
        'Team1Score',
        'Team2Score',
        'Game_Winner',
        'LeagueID'
    ];
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    public function team()
    {
        return $this->belongsTo(FootballTeam::class, 'TeamID', 'TeamID');
    }

    /**
     * Relationship to the Footballplayers table.
     */
    public function player()
    {
        return $this->belongsTo(FootballPlayers::class, 'PlayerID', 'PlayerID');
    }

    /**
     * Relationship to the users table.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

