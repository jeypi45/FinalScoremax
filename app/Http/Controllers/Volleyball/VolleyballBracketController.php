<?php

namespace App\Http\Controllers\Volleyball;
use App\Http\Controllers\Controller;

use App\Models\VolleyballTeam;
use App\Models\VolleyballBracket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class VolleyballBracketController extends Controller
{
    public function index()
    {
        $teams = VolleyballTeam::all();  // Getting teams for displaying in the bracket
        $brackets = VolleyballBracket::where('user_id', Auth::id())->get(); // Filter by the authenticated user

        return Inertia::render('Volleyball/VolleyballBracket', [
            'teams' => $teams,
            'brackets' => $brackets
        ]);
    }

    public function userIndex()
    {
        $teams = VolleyballTeam::all(); // Getting teams for displaying in the bracket
        $brackets = VolleyballBracket::with(['team1', 'team2']) // Eager load related teams
                        ->where('user_id', Auth::id())
                        ->get();
    
        return Inertia::render('User-View/UserVolleyballBracket', [
            'teams' => $teams,
            'brackets' => $brackets
        ]);
    }
    // Store the selected teams and create a new bracket
    public function store(Request $request)
    {
        $teams = VolleyballTeam::whereIn('TeamID', $request->teams)->get();
        
        if ($teams->count() != 8) {
            return back()->withErrors(['message' => 'You need exactly 8 teams to create a bracket']);
        }

        $round = 1;
        $userId = Auth::id();

        // Create round 1 matches
        for ($i = 0; $i < 8; $i += 2) {
            VolleyballBracket::create([
                'Team1ID' => $teams[$i]->TeamID,
                'Team2ID' => $teams[$i + 1]->TeamID,
                'Round' => $round,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('volleyballbracket.index');
    }

    // Update match result after a game
    public function update(Request $request, $matchId)
    {
        $match = VolleyballBracket::findOrFail($matchId);
        $match->update([
            'WinnerID' => $request->winner_id,
            'team1_score' => $request->team1_score,
            'team2_score' => $request->team2_score
        ]);

        return back();
    }
}
