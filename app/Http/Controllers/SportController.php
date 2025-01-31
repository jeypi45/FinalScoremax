<?php

namespace App\Http\Controllers;

use App\Models\BasketballTeam;
use App\Models\BasketballPlayers;
use App\Models\VolleyballTeam;
use App\Models\VolleyballPlayers;
use App\Models\BaseballTeam;
use App\Models\BaseballPlayers;
use App\Models\SepakTakrawTeam;
use App\Models\SepakTakrawPlayers;
use App\Models\FootballTeam;
use App\Models\FootballPlayers;
use App\Models\League;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SportController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();
        
        // Fetch the active league for the user
        $activeLeague = League::where('IsActive', true)
            ->where('user_id', $user->id)
            ->first();

        // Initialize counts in case there's no active league
        $teamCounts = [
            'Basketball Teams' => 0,
            'Volleyball Teams' => 0,
            'Baseball Teams' => 0,
            'Sepak Takraw Teams' => 0,
            'Football Teams' => 0,
        ];
        $playerCounts = [
            'Basketball Players' => 0,
            'Volleyball Players' => 0,
            'Baseball Players' => 0,
            'Sepak Takraw Players' => 0,
            'Football Players' => 0,
        ];

        if ($activeLeague) {
            // Only fetch team and player counts if an active league is found
            $teamCounts = [
                'Basketball Teams' => BasketballTeam::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Volleyball Teams' => VolleyballTeam::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Baseball Teams' => BaseballTeam::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Sepak Takraw Teams' => SepakTakrawTeam::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Football Teams' => FootballTeam::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
            ];

            $playerCounts = [
                'Basketball Players' => BasketballPlayers::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Volleyball Players' => VolleyballPlayers::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Baseball Players' => BaseballPlayers::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Sepak Takraw Players' => SepakTakrawPlayers::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
                'Football Players' => FootballPlayers::where('LeagueID', $activeLeague->LeagueID)
                    ->where('user_id', $user->id)
                    ->count(),
            ];
        }

        // Return the view with or without the active league data
        return inertia('Dashboard', [
            'teamCounts' => $teamCounts,
            'playerCounts' => $playerCounts,
            'activeLeague' => $activeLeague, // This can be null if no active league
            'noActiveLeagueMessage' => $activeLeague ? null : 'There is no active league at the moment.',
        ]);
    }

    public function getFeedbackData(Request $request)
    {
        // Fetch the active league
        $user = $request->user();
        $activeLeague = League::where('IsActive', true)->where('user_id', $user->id)->first();
    
        if (!$activeLeague) {
            // Log for debugging
            Log::error('No active league found for user: ' . $user->id);
            return response()->json(['message' => 'No active league found for this user.'], 404);
        }
    
        // Query feedback data
        try {
            $feedbackData = DB::table('feedback')
                ->select(
                    'team_type',
                    'team_name',
                    DB::raw('SUM(CASE WHEN LOWER(message) = "positive" THEN 1 ELSE 0 END) as positive_count'),
                    DB::raw('SUM(CASE WHEN LOWER(message) = "negative" THEN 1 ELSE 0 END) as negative_count')
                )
                ->where('league_id', $activeLeague->LeagueID)
                ->groupBy('team_type', 'team_name')
                ->get();
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error fetching feedback data: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching feedback data.'], 500);
        }
    
        // Log feedback data to verify it's correct
        Log::info('Feedback Data:', ['data' => $feedbackData]);
    
        return response()->json($feedbackData);
    }
    

    
    


}
