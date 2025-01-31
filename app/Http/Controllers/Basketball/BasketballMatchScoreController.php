<?php


namespace App\Http\Controllers\Basketball;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasketballMatchScore;

class BasketballMatchScoreController extends Controller
{
    /**
     * Fetch all match scores for the active league.
     */
    public function index()
    {
        // Get the active league for the authenticated user
        $activeLeague = auth()->user()->leagues()->where('IsActive', true)->first();

        if (!$activeLeague) {
            return response()->json(['error' => 'No active league found.'], 400);
        }

        // Retrieve match scores for the active league
        $matchScores = BasketballMatchScore::where('LeagueID', $activeLeague->LeagueID)->get();

        return response()->json($matchScores);
    }

    /**
     * Store match score for the active league.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'team1_name' => 'required|string|max:255',
            'team2_name' => 'required|string|max:255',
            'team1_score' => 'required|integer',
            'team2_score' => 'required|integer',
            'game_winner' => 'nullable|string|max:255',
        ]);

        // Get the active league for the authenticated user
        $activeLeague = auth()->user()->leagues()->where('IsActive', true)->first();

        if (!$activeLeague) {
            return response()->json(['error' => 'No active league found.'], 400);
        }

        // Create a new match score record associated with the active league
        BasketballMatchScore::create([
            'user_id' => auth()->id(),
            'LeagueID' => $activeLeague->LeagueID, // Associate match score with active league
            'Team1Name' => $validated['team1_name'],
            'Team2Name' => $validated['team2_name'],
            'Team1Score' => $validated['team1_score'],
            'Team2Score' => $validated['team2_score'],
            'Game_Winner' => $validated['game_winner'], // Store the game winner
        ]);

        return response()->json(['message' => 'Match score saved successfully!'], 200);
    }
}
