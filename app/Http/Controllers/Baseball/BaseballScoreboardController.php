<?php


namespace App\Http\Controllers\Baseball;
use App\Http\Controllers\Controller;

use App\Models\BaseballTeam;
use App\Models\BaseballMatchDetails;
use Inertia\Inertia;

class BaseballScoreboardController extends Controller
{
    public function index()
    {
        $teams = BaseballTeam::all(); // Get all teams
        $matchDetails = BaseballMatchDetails::with(['player', 'team'])->get(); // Include player and team details

        return Inertia::render('BaseballScoreboard', [
            'teams' => $teams,
            'matchDetails' => $matchDetails,
        ]);
    }
    public function userIndex()
{
    $teams =  BaseballTeam::all(); // Get all teams
    $matchDetails = BaseballMatchDetails::with(['player', 'team'])->get(); 


    return Inertia::render('User-View/UserBaseballScoreboard', [
        'teams' => $teams,
       'matchDetails' => $matchDetails,
    ]);
}
}
