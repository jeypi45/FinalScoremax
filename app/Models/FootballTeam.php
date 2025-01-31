<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballTeam extends Model
{
    use HasFactory;

    protected $primaryKey = 'TeamID';
    protected $table = 'footballteams';
    protected $fillable = [
        'TeamName',
        'CoachName',
        'PlayerCount',
        'user_id',
        'LeagueID'
      
    ];
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Football Players
    public function players()
{
    return $this->hasMany(FootballPlayers::class, 'TeamID', 'TeamID');
}
public function FootballmatchDetails()
{
    return $this->hasMany(FootballMatchDetails::class, 'TeamID', 'TeamID');
}
    
}
