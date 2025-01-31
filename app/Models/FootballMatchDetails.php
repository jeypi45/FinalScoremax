<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballMatchDetails extends Model
{
    use HasFactory;
    protected $table = 'footballmatchdetails';

    protected $primaryKey = 'MatchDetailID'; // Use custom primary key

    protected $fillable = [
        'Goals',
        'Assists',
        'YellowCard',
        'RedCard',
        'TeamID',
        'PlayerID',
        'user_id',
        'LeagueID'
    ];
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    /**
     * Relationship to the Footballteams table.
     */
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

