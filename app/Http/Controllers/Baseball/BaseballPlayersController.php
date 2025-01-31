<?php

namespace App\Http\Controllers\Baseball;
use App\Http\Controllers\Controller;

use App\Models\BaseballPlayers;
use App\Models\BaseballTeam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BaseballPlayersController extends Controller
{
    /**
     * Display a listing of the players.
     */
    public function index(Request $request)
    {
        $leagueId = $request->query('LeagueID'); // Retrieve the league ID from the query parameter
    
        $players = BaseballPlayers::where('user_id', auth()->id())
            ->when($leagueId, function ($query, $leagueId) {
                $query->whereHas('team', function ($teamQuery) use ($leagueId) {
                    $teamQuery->where('LeagueID', $leagueId);
                });
            })
            ->with('team') // Ensure the related team is loaded
            ->get();
    
        $teams = BaseballTeam::where('user_id', auth()->id())
            ->when($leagueId, function ($query, $leagueId) {
                $query->where('LeagueID', $leagueId);
            })
            ->get();
    
        return Inertia::render('Baseball/BaseballPlayers', [
            'players' => $players,
            'teams' => $teams,
            'auth' => [
                'user' => auth()->user(),
            ],
        ]);
    }
    

    /**
     * Store a new player.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'FullName' => 'required|string|max:100',
        'Height' => 'required|numeric|between:30,300',
        'Weight' => 'required|numeric|min:30|max:200',
        'Position' => 'required|string|max:50',
        'Jersey_num' => 'required|integer|min:0|max:99',
        'TeamID' => 'required|exists:baseballteams,TeamID',
    ]);

    // Find the selected team
    $team = BaseballTeam::findOrFail($validatedData['TeamID']);

    // Assign the team name and league ID to the player
    $validatedData['TeamName'] = $team->TeamName;
    $validatedData['LeagueID'] = $team->LeagueID;
    $validatedData['user_id'] = auth()->id();

    // Create the player
    $player = BaseballPlayers::create($validatedData);

    return response()->json($player, 201);
}


    /**
     * Update an existing player.
     */
    public function update(Request $request, $id)
    {
        $player = $this->findPlayer($id);

        $validatedData = $request->validate([
            'FullName' => 'required|string|max:100',
            'Height' => 'required|numeric|between:30,300',
            'Weight' => 'required|numeric|min:30|max:200',
            'Position' => 'required|string|max:50',
            'Jersey_num' => 'required|integer|min:0|max:99',
            'TeamID' => 'required|exists:baseballteams,TeamID',
        ]);

        // Get the TeamName based on the TeamID
        $team = BaseballTeam::findOrFail($validatedData['TeamID']);
        $validatedData['TeamName'] = $team->TeamName;

        // Update the player
        $player->update($validatedData);

        return response()->json($player, 200);
    }

    /**
     * Delete a player.
     */
    public function destroy($id)
    {
        $player = $this->findPlayer($id);
        $player->delete();

        return response()->json(['message' => 'Player deleted successfully.'], 200);
    }

    /**
     * Find a player by PlayerID and ensure it belongs to the authenticated user.
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    private function findPlayer($id)
    {
        return BaseballPlayers::where('PlayerID', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    public function showScoreboard()
    {
        $teams = BaseballTeam::all();  // Fetch all Baseball teams
        $baseballPlayers = BaseballPlayers::all();  // Fetch all Baseball players

        return Inertia::render('Baseball/BaseballScoreboard', [
            'teams' => $teams,
            'baseballPlayers' => $baseballPlayers,  // Pass players to the view
        ]);
    }

    public function UsershowScoreboard()
    {
        $teams = BaseballTeam::all();  // Fetch all Baseball teams
        $baseballPlayers = BaseballPlayers::all();  // Fetch all Baseball players

        return Inertia::render('User-View/UserBaseballScoreboard', [
            'teams' => $teams,
            'baseballPlayers' => $baseballPlayers,  // Pass players to the view
        ]);
    }
}
