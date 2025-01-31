<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepakTakrawMatchDetails extends Model
{
    use HasFactory;
    protected $table = 'sepaktakrawmatchdetails';

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
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    /**
     * Relationship to the SepakTakrawteams table.
     */
    public function team()
    {
        return $this->belongsTo(SepakTakrawTeam::class, 'TeamID', 'TeamID');
    }

    /**
     * Relationship to the SepakTakrawplayers table.
     */
    public function player()
    {
        return $this->belongsTo(SepakTakrawPlayers::class, 'PlayerID', 'PlayerID');
    }

    /**
     * Relationship to the users table.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

