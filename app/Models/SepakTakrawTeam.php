<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepakTakrawTeam extends Model
{
    use HasFactory;

    protected $primaryKey = 'TeamID';
    protected $table = 'SepakTakrawteams';
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
    return $this->hasMany(SepakTakrawPlayers::class, 'TeamID', 'TeamID');
}
public function SepakTakrawmatchDetails()
{
    return $this->hasMany(SepakTakrawMatchDetails::class, 'TeamID', 'TeamID');
}
    

}
