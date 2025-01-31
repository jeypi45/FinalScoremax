<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseballTeam extends Model
{
    use HasFactory;

    protected $primaryKey = 'TeamID';
    protected $table = 'baseballteams';
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

    // Relationship with baseball Players
    public function players()
{
    return $this->hasMany(BaseballPlayers::class, 'TeamID', 'TeamID');
}
public function BaseballmatchDetails()
{
    return $this->hasMany(BaseballMatchDetails::class, 'TeamID', 'TeamID');
}
    
}
