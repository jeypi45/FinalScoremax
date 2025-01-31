<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketballMatchDetails extends Model
{
    use HasFactory;
    protected $table = 'basketballmatchdetails';

    protected $primaryKey = 'MatchDetailID'; // Use custom primary key

    protected $fillable = [
        'Points',
        'Assists',
        'Rebounds',
        'Blocks',
        'Fouls',
        'TeamID',
        'PlayerID',
        'user_id', 'LeagueID'
    ];

    /**
     * Relationship to the basketballteams table.
     */ public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    public function team()
    {
        return $this->belongsTo(BasketballTeam::class, 'TeamID', 'TeamID');
    }

    /**
     * Relationship to the basketballplayers table.
     */
    public function player()
    {
        return $this->belongsTo(BasketballPlayers::class, 'PlayerID', 'PlayerID');
    }

    /**
     * Relationship to the users table.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

