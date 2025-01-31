<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolleyballPlayers extends Model
{
    use HasFactory;

    protected $table = 'volleyballplayers';
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
        return $this->belongsTo(VolleyballTeam::class, 'TeamID');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function VolleyballmatchDetails()
    {
        return $this->hasMany(VolleyballMatchDetails::class, 'PlayerID', 'PlayerID');
    }
}
