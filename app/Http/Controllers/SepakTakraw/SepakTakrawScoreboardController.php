<?php

namespace App\Http\Controllers\SepakTakraw;
use App\Http\Controllers\Controller;


use App\Models\SepakTakrawTeam;
use App\Models\SepakTakrawMatchDetails;
use Inertia\Inertia;

class SepakTakrawScoreboardController extends Controller
{
    public function index()
    {
        $teams = SepakTakrawTeam::all(); // Get all teams
        $matchDetails = SepakTakrawMatchDetails::with(['player', 'team'])->get(); // Include player and team details

        return Inertia::render('SepakTakrawScoreboard', [
            'teams' => $teams,
            'matchDetails' => $matchDetails,
        ]);
    }
    public function userIndex()
    {
        $teams = SepakTakrawTeam::all(); // Get all teams
        $matchDetails = SepakTakrawMatchDetails::with(['player', 'team'])->get(); 
    
    
        return Inertia::render('User-View/UserSepakTakrawScoreboard', [
            'teams' => $teams,
           'matchDetails' => $matchDetails,
        ]);
    }
}
