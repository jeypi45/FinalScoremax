<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $primaryKey = 'LeagueID';

    protected $fillable = [
       'LeagueName',
        'StartDate',
        'EndDate',
        'IsActive',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function basketballTeams()
    {
        return $this->hasMany(BasketballTeam::class, 'LeagueID');
    }

public function basketballPlayers()
{
    return $this->hasMany(BasketballPlayers::class, 'LeagueID');
}

public function basketballBrackets()
    {
        return $this->hasMany(BasketballBracket::class, 'LeagueID');
    }
public function BasketballmatchDetails()
{
    return $this->hasMany(BasketballMatchDetails::class, 'LeagueID');
}

public function volleyballTeams()
{
    return $this->hasMany(VolleyballTeam::class, 'LeagueID');
}

public function volleyballPlayers()
{
    return $this->hasMany(VolleyballPlayers::class, 'LeagueID');
}

public function volleyballBrackets()
    {
        return $this->hasMany(VolleyballBracket::class, 'LeagueID');
    }
    public function VolleyballmatchDetails()
{
    return $this->hasMany(VolleyballMatchDetails::class, 'LeagueID');
}

public function baseballTeams()
{
    return $this->hasMany(BaseballTeam::class, 'LeagueID');
}

public function baseballPlayers()
{
    return $this->hasMany(BaseballPlayers::class, 'LeagueID');
}

public function baseballBrackets()
    {
        return $this->hasMany(BaseballBracket::class, 'LeagueID');
    }
public function BaseballmatchDetails()
{
    return $this->hasMany(BaseballMatchDetails::class, 'LeagueID');
}

public function sepaktakrawTeams()
{
    return $this->hasMany(SepakTakrawTeam::class, 'LeagueID');
}

public function sepaktakrawPlayers()
{
    return $this->hasMany(SepakTakrawPlayers::class, 'LeagueID');
}

public function sepaktakrawBrackets()
    {
        return $this->hasMany(SepakTakrawBracket::class, 'LeagueID');
    }
public function sepaktakrawmatchDetails()
{
    return $this->hasMany(SepakTakrawMatchDetails::class, 'LeagueID');
}



public function footballTeams()
    {
        return $this->hasMany(FootballTeam::class, 'LeagueID');
    }

public function footballPlayers()
{
    return $this->hasMany(FootballPlayers::class, 'LeagueID');
}

public function footballBrackets()
    {
        return $this->hasMany(FootballBracket::class, 'LeagueID');
    }
public function FootballmatchDetails()
{
    return $this->hasMany(FootballMatchDetails::class, 'LeagueID');
}


}


