<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketballGameState extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id', 'team_a_id', 'team_b_id', 'score_a', 'score_b', 'timer', 
        'period', 'players_a', 'players_b', 'timeouts_a', 'timeouts_b', 'mvp'
    ];

    protected $casts = [
        'players_a' => 'array',
        'players_b' => 'array',
    ];
}

