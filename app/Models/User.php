<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Define relationship with BasketballTeam
    public function leagues()
    {
        return $this->hasMany(League::class);
    }

public function basketballTeams()
    {
        return $this->hasMany(BasketballTeam::class, 'user_id');
    }

public function basketballPlayers()
{
    return $this->hasMany(BasketballPlayers::class, 'user_id');
}

public function basketballBrackets()
    {
        return $this->hasMany(BasketballBracket::class, 'user_id');
    }
public function BasketballmatchDetails()
{
    return $this->hasMany(BasketballMatchDetails::class, 'user_id');
}

public function volleyballTeams()
{
    return $this->hasMany(VolleyballTeam::class, 'user_id');
}

public function volleyballPlayers()
{
    return $this->hasMany(VolleyballPlayers::class, 'user_id');
}

public function volleyballBrackets()
    {
        return $this->hasMany(VolleyballBracket::class, 'user_id');
    }
    public function VolleyballmatchDetails()
{
    return $this->hasMany(VolleyballMatchDetails::class, 'user_id');
}

public function baseballTeams()
{
    return $this->hasMany(BaseballTeam::class, 'user_id');
}

public function baseballPlayers()
{
    return $this->hasMany(BaseballPlayers::class, 'user_id');
}

public function baseballBrackets()
    {
        return $this->hasMany(BaseballBracket::class, 'user_id');
    }
public function BaseballmatchDetails()
{
    return $this->hasMany(BaseballMatchDetails::class, 'user_id');
}

public function sepaktakrawTeams()
{
    return $this->hasMany(SepakTakrawTeam::class, 'user_id');
}

public function sepaktakrawPlayers()
{
    return $this->hasMany(SepakTakrawPlayers::class, 'user_id');
}

public function sepaktakrawBrackets()
    {
        return $this->hasMany(SepakTakrawBracket::class, 'user_id');
    }
public function sepaktakrawmatchDetails()
{
    return $this->hasMany(SepakTakrawMatchDetails::class, 'user_id');
}



public function footballTeams()
    {
        return $this->hasMany(FootballTeam::class, 'user_id');
    }

public function footballPlayers()
{
    return $this->hasMany(FootballPlayers::class, 'user_id');
}

public function footballBrackets()
    {
        return $this->hasMany(FootballBracket::class, 'user_id');
    }
public function FootballmatchDetails()
{
    return $this->hasMany(FootballMatchDetails::class, 'user_id');
}


}
