<?php

namespace App\Http\Controllers\Volleyball;
use App\Http\Controllers\Controller;


use App\Models\VolleyballTeam;
use App\Models\VolleyballMatchDetails;
use Inertia\Inertia;

class VolleyballScoreboardController extends Controller
{
    public function index()
    {
        $teams = VolleyballTeam::all(); // Get all teams
        $matchDetails = VolleyballMatchDetails::with(['player', 'team'])->get(); // Include player and team details

        return Inertia::render('VolleyballScoreboard', [
            'teams' => $teams,
            'matchDetails' => $matchDetails,
        ]);
    }
    public function userIndex()
    {
        $teams = VolleyballTeam::all(); // Get all teams
        $matchDetails = VolleyballMatchDetails::with(['player', 'team'])->get(); 
    
    
        return Inertia::render('User-View/UserVolleyballScoreboard', [
            'teams' => $teams,
           'matchDetails' => $matchDetails,
        ]);
    }
}
