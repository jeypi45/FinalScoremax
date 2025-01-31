<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseballMatchDetails extends Model
{
    use HasFactory;
    protected $table = 'baseballmatchdetails';

    protected $primaryKey = 'MatchDetailID'; // Use custom primary key

    protected $fillable = [
        'Runs',
        'Hits',
        'Home_Runs',
        'Strikeouts',
        'Errors',
        'TeamID',
        'PlayerID',
        'user_id', 'LeagueID'
        
    ];

    /**
     * Relationship to the baseballlteams table.
     */
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    public function team()
    {
        return $this->belongsTo(BaseballTeam::class, 'TeamID', 'TeamID');
    }

    /**
     * Relationship to the Baseballlplayers table.
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

