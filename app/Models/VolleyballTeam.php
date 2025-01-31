<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolleyballTeam extends Model
{
    use HasFactory;

    protected $primaryKey = 'TeamID';
    protected $table = 'Volleyballteams';
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

    public function players()
{
    return $this->hasMany(VolleyballPlayers::class, 'TeamID', 'TeamID');
}
public function VolleyballmatchDetails()
{
    return $this->hasMany(VolleyballMatchDetails::class, 'TeamID', 'TeamID');
}
    

}
