<?php

namespace App\Http\Controllers\SepakTakraw;
use App\Http\Controllers\Controller;

use App\Models\SepakTakrawPlayers;
use App\Models\SepakTakrawTeam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SepakTakrawPlayersController extends Controller
{
    /**
     * Display a listing of the players.
     */
    public function index(Request $request)
    {
        $leagueId = $request->query('LeagueID'); // Retrieve the league ID from the query parameter
    
        $players = SepakTakrawPlayers::where('user_id', auth()->id())
            ->when($leagueId, function ($query, $leagueId) {
                $query->whereHas('team', function ($teamQuery) use ($leagueId) {
                    $teamQuery->where('LeagueID', $leagueId);
                });
            })
            ->with('team') // Ensure the related team is loaded
            ->get();
    
        $teams = SepakTakrawTeam::where('user_id', auth()->id())
            ->when($leagueId, function ($query, $leagueId) {
                $query->where('LeagueID', $leagueId);
            })
            ->get();
    
        return Inertia::render('SepakTakraw/SepakTakrawPlayers', [
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
        'TeamID' => 'required|exists:sepaktakrawteams,TeamID',
    ]);

    // Find the selected team
    $team = SepakTakrawTeam::findOrFail($validatedData['TeamID']);

    // Assign the team name and league ID to the player
    $validatedData['TeamName'] = $team->TeamName;
    $validatedData['LeagueID'] = $team->LeagueID;
    $validatedData['user_id'] = auth()->id();

    // Create the player
    $player = SepakTakrawPlayers::create($validatedData);

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
            'TeamID' => 'required|exists:sepaktakrawteams,TeamID',
        ]);

        // Get the TeamName based on the TeamID
        $team = SepakTakrawTeam::findOrFail($validatedData['TeamID']);
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
        return SepakTakrawPlayers::where('PlayerID', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    public function showScoreboard()
    {
        $teams = SepakTakrawTeam::all();  // Fetch all SepakTakraw teams
        $sepaktakrawPlayers = SepakTakrawPlayers::all();  // Fetch all SepakTakraw players

        return Inertia::render('SepakTakraw/SepakTakrawScoreboard', [
            'teams' => $teams,
            'sepaktakrawPlayers' => $sepaktakrawPlayers,  // Pass players to the view
        ]);
    }

    public function UsershowScoreboard()
    {
        $teams = SepakTakrawTeam::all();  // Fetch all sepaktakraw teams
        $sepaktakrawPlayers = SepakTakrawPlayers::all();  // Fetch all SepakTakraw players

        return Inertia::render('User-View/UserSepakTakrawScoreboard', [
            'teams' => $teams,
            'sepaktakrawPlayers' => $sepaktakrawPlayers,  // Pass players to the view
        ]);
    }
}
