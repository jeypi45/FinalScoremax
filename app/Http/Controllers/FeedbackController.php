<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    // Store feedback
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'team_id' => 'nullable|integer',
           'team_name' => 'required_with:team_id|string',
            'team_type' => 'nullable|string',
            'league_id' => 'required|integer', // Validate league ID
        ]);

        // Log the incoming data
        Log::info('Feedback received:', [
            'name' => $request->name,
            'message' => $request->message,
            'team_id' => $request->team_id,
            'team_name' => $request->team_name,
            'team_type' => $request->team_type,
            'league_id' => $request->league_id,
        ]);

        // Store the feedback in the database
        $feedback = DB::table('feedback')->insert([
            'name' => $request->name,
            'message' => $request->message,
            'team_id' => $request->team_id, // Store the selected team ID
            'team_name' => $request->team_name, // Store the team name
            'team_type' => $request->team_type, // Store the team type
            'league_id' => $request->league_id, // Store the selected league ID
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Return success response
        return response()->json(['message' => 'Feedback stored successfully!']);
    }

    // Fetch teams
    public function getTeams(Request $request)
    {
        // Get the league_id from the request
        $leagueId = $request->input('league_id');
    
        // If league_id is provided, filter teams by league and sport
        $teams = [];
        if ($leagueId) {
            $teams['Basketball'] = DB::table('basketballteams')->where('LeagueID', $leagueId)->select('TeamID', 'TeamName')->get();
            $teams['Volleyball'] = DB::table('volleyballteams')->where('LeagueID', $leagueId)->select('TeamID', 'TeamName')->get();
            $teams['Baseball'] = DB::table('baseballteams')->where('LeagueID', $leagueId)->select('TeamID', 'TeamName')->get();
            $teams['Sepaktakraw'] = DB::table('sepaktakrawteams')->where('LeagueID', $leagueId)->select('TeamID', 'TeamName')->get();
            $teams['Football'] = DB::table('footballteams')->where('LeagueID', $leagueId)->select('TeamID', 'TeamName')->get();
        } else {
            // If no league_id is provided, fetch all teams from all sports
            $teams['Basketball'] = DB::table('basketballteams')->select('TeamID', 'TeamName')->get();
            $teams['Volleyball'] = DB::table('volleyballteams')->select('TeamID', 'TeamName')->get();
            $teams['Baseball'] = DB::table('baseballteams')->select('TeamID', 'TeamName')->get();
            $teams['Sepaktakraw'] = DB::table('sepaktakrawteams')->select('TeamID', 'TeamName')->get();
            $teams['Football'] = DB::table('footballteams')->select('TeamID', 'TeamName')->get();
        }
    
        // Return the filtered teams based on league_id or all teams
        return response()->json($teams);
    }
    

    // Fetch leagues
    public function getLeagues(Request $request)
    {
        // Fetch all active leagues
        $leagues = DB::table('leagues')
            ->select('LeagueID', 'LeagueName', 'StartDate', 'EndDate', 'IsActive')
            ->where('IsActive', true) // Optional: Only return active leagues
            ->get();

        return response()->json($leagues);
    }
}
