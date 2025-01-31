<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolleyballMatchDetails extends Model
{
    use HasFactory;
    protected $table = 'volleyballmatchdetails';

    protected $primaryKey = 'MatchDetailID'; // Use custom primary key

    protected $fillable = [
        'Kills',
        'Aces',
        'Digs',
        'Blocks',
        'Service_Errors',
        'TeamID',
        'PlayerID',
        'user_id',
        'LeagueID'
    ];

    /**
     * Relationship to the volleyballteams table.
     */
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

