<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FootballSchedule;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

class FootballScheduleController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $leagues = $user->leagues()->get(); // Ensure user and relationship exist

    return view('football.match_scores', compact('leagues'));

    
}

public function store(Request $request)
{
    \Log::info($request->all()); // Logs the entire incoming request

    $schedule = $request->input('schedule');

    foreach ($schedule as $match) {
        \Log::info($match); // Log each match to see if 'date' is included
        FootballSchedule::create([
            'LeagueID' => $match['LeagueID'] ?? null,
            'user_id' => auth()->id(),
            'Team1Name' => $match['team_1'],
            'Team2Name' => $match['team_2'],
            'Game_Winner' => $match['game_winner'] ?? null,
          'match_date' => $match['date'] ?? null, // Use null if 'date' is not provided

            'match_time' => $match['match_time'],
        ]);
    }

    return response()->json(['message' => 'Schedule saved successfully!']);
}



}
