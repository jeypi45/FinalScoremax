<?php

namespace App\Http\Controllers\Basketball;
use App\Http\Controllers\Controller;
use App\Models\BasketballTeam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BasketballTeamController extends Controller
{
    /**
     * Display a listing of the teams.
     */
    public function index()
{
    // Get the current user's basketball teams
    $teams = auth()->user()->basketballTeams;

    // Get the active league for the user (assuming you have a method to get the active league)
    $activeLeague = auth()->user()->activeLeague; // Assuming the active league is stored in the user model

    return Inertia::render('Basketball/BasketballTeams', [
        'teams' => $teams,
        'activeLeague' => $activeLeague, 
        'auth' => [
            'user' => auth()->user(),
        ],
    ]);
}


    /**
     * Store a new team.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'TeamName' => 'required|string|max:50',
            'CoachName' => 'required|string|max:50',
            'PlayerCount' => 'required|integer',
        ]);
    
        // Get the active league
        $activeLeague = auth()->user()->leagues()->where('IsActive', true)->first();
    
        // Ensure there's an active league
        if (!$activeLeague) {
            return response()->json(['error' => 'No active league found.'], 400); // Return error if no active league
        }
    
        // Create the new team and associate it with the active league
        $team = BasketballTeam::create([
            'TeamName' => $validatedData['TeamName'],
            'CoachName' => $validatedData['CoachName'],
            'PlayerCount' => $validatedData['PlayerCount'],
            'user_id' => auth()->id(),
            'LeagueID' => $activeLeague->LeagueID, // Add the LeagueID to the team
        ]);
    
        // Return the newly created team with success status
        return response()->json($team, 201);
    }
    

    /**
     * Update an existing team.
     */
    public function update(Request $request, $id)
    {
        $team = $this->findTeam($id); // Fetch the team with common logic

        $validatedData = $request->validate([
            'TeamName' => 'required|string|max:50',
            'CoachName' => 'required|string|max:50',
            'PlayerCount' => 'required|integer',
        ]);

        $team->update($validatedData);

        return response()->json($team, 200); // Return the updated record
    }

    /**
     * Delete a team.
     */
    public function destroy($id)
    {
        $team = $this->findTeam($id); // Fetch the team with common logic
        $team->delete();

        return response()->json(['message' => 'Team deleted successfully.'], 200);
    }

    /**
     * Display the schedule page.
     */

     public function schedule(Request $request)
     {
         $user = auth()->user();
         $activeLeague = $user->leagues()->where('IsActive', true)->first();
     
         if (!$activeLeague) {
             return redirect()->back()->with('error', 'No active league found.');
         }
     
         // Fetch the teams for the active league
         $teams = BasketballTeam::where('LeagueID', $activeLeague->LeagueID)->get();
     
         return Inertia::render('Basketball/BasketballSchedule', [
             'initialTeams' => $teams->toArray(),
             'activeLeagueID' => $activeLeague->LeagueID, // Pass the LeagueID here
         ]);
     }
     
     
    

    /**
     * Display the scoreboard page.
     */
    public function scoreboard()
    {
        $teams = BasketballTeam::with('players')->where('user_id', auth()->id())->get();

        return Inertia::render('Basketball/BasketballScoreboard', [
            'teams' => $teams,
        ]);
    }

    /**
     * Find a team by TeamID and ensure it belongs to the authenticated user.
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    private function findTeam($id)
    {
        return BasketballTeam::where('TeamID', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }
}
