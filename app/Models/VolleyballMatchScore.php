<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class VolleyballMatchScore extends Model
{
    use HasFactory;

    protected $table = 'volleyball_match_score';

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
        return $this->belongsTo(VolleyballTeam::class, 'TeamID', 'TeamID');
    }

    /**
     * Relationship to the Volleyballplayers table.
     */
    public function player()
    {
        return $this->belongsTo(VolleyballPlayers::class, 'PlayerID', 'PlayerID');
    }

    /**
     * Relationship to the users table.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
