<?php

namespace App\Http\Controllers\Football;
use App\Http\Controllers\Controller;

use App\Models\FootballTeam;
use App\Models\FootballMatchDetails;
use Inertia\Inertia;

class FootballScoreboardController extends Controller
{
    public function index()
    {
        $teams = FootballTeam::all(); // Get all teams
        $matchDetails = FootballMatchDetails::with(['player', 'team'])->get(); // Include player and team details

        return Inertia::render('FootballScoreboard', [
            'teams' => $teams,
            'matchDetails' => $matchDetails,
        ]);
    }
    public function userIndex()
    {
        $teams = FootballTeam::all(); // Get all teams
        $matchDetails = FootballMatchDetails::with(['player', 'team'])->get(); 
    
    
        return Inertia::render('User-View/UserFootballScoreboard', [
            'teams' => $teams,
           'matchDetails' => $matchDetails,
        ]);
    }
}
