<?php



namespace App\Http\Controllers\Baseball;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BaseballMatchScore;
use App\Models\BaseballMatchDetails;

class BaseballMatchScoreController extends Controller
{
    public function index()
    {
        $matchScores = BaseballMatchScore::all(); // Retrieve all match scores from the database
        return response()->json($matchScores); // Return as JSON response
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'team1_name' => 'required|string|max:255',
        'team2_name' => 'required|string|max:255',
        'team1_score' => 'required|integer',
        'team2_score' => 'required|integer',
        'game_winner' => 'nullable|string', // Make sure it's validated
    ]);

    // Store match score along with game winner
    BaseballMatchScore::create([
        'user_id' => auth()->id(),
        'Team1Name' => $validated['team1_name'],
        'Team2Name' => $validated['team2_name'],
        'Team1Score' => $validated['team1_score'],
        'Team2Score' => $validated['team2_score'],
        'Game_Winner' => $validated['game_winner'],  // Store the game winner
    ]);

    return response()->json(['message' => 'Match score saved successfully!']);
}
      
}

