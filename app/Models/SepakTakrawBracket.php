<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepakTakrawBracket extends Model
{
    use HasFactory;

    protected $table = 'sepaktakraw_brackets';

    protected $fillable = [
        'Team1ID', 'Team2ID', 'WinnerID', 'Round', 'user_id','LeagueID'
    ];
    public function league()
    {
        return $this->belongsTo(League::class, 'LeagueID');
    }
    public function team1()
    {
        return $this->belongsTo(SepakTakrawTeam::class, 'Team1ID');
    }

    public function team2()
    {
        return $this->belongsTo(SepakTakrawTeam::class, 'Team2ID');
    }

    public function winner()
    {
        return $this->belongsTo(SepakTakrawTeam::class, 'WinnerID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
