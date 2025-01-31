<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballPlayers extends Model
{
    use HasFactory;

    protected $table = 'footballplayers';
    protected $primaryKey = 'PlayerID';

    protected $fillable = [
        'FullName',
        'Height',
        'Weight',
        'Position',
        'Jersey_num',
        'TeamID',
        'TeamName',
        'user_id',
        'LeagueID'
    ];
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    public function team()
    {
        return $this->belongsTo(FootballTeam::class, 'TeamID');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function FootballmatchDetails()
    {
        return $this->hasMany(FootballMatchDetails::class, 'PlayerID', 'PlayerID');
    }
}
