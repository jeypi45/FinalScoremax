<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseballMatchScore extends Model
{
    use HasFactory;

    protected $table = 'baseball_match_score';

    protected $fillable = [
        'user_id',
        'LeagueID',
        'Team1Name',
        'Team2Name',
        'Team1Score',
        'Team2Score',
        'Game_Winner',
    ];
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    public function team()
    {
        return $this->belongsTo(BaseballTeam::class, 'TeamID', 'TeamID');
    }

    /**
     * Relationship to the Baseballplayers table.
     */
    public function player()
    {
        return $this->belongsTo(BaseballPlayers::class, 'PlayerID', 'PlayerID');
    }

    /**
     * Relationship to the users table.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

