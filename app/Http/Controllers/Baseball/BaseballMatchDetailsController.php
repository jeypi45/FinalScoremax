<?php


namespace App\Http\Controllers\Baseball;
use App\Http\Controllers\Controller;

use App\Models\BaseballMatchDetails;
use Illuminate\Http\Request;

class BaseballMatchDetailsController extends Controller
{

    public function index()
    {
        $BaseballmatchDetails = BaseballMatchDetails::with('player', 'team') // Ensure the relationships are loaded
            ->get()
            ->map(function ($match) {
                return [
                    'PlayerName' => $match->player->FullName, // Assuming the relationship is named 'player'
                    'TeamName' => $match->team->TeamName, // Assuming the relationship is named 'team'
                    'Runs' => $match->Runs,
                    'Hits' => $match->Hits,
                    'Home_Runs' => $match->Home_Runs,
                    'Strikeouts' => $match->Strikeouts,
                    'Errors' => $match->Errors,
                    'created_at' => $match->created_at,
                ];
            });
    
        return response()->json($BaseballmatchDetails);
    }



     public function store(Request $request)
    {
        $data = $request->validate([
            'match_details' => 'required|array',
            'match_details.*.team_id' => 'required|integer',
            'match_details.*.player_id' => 'required|integer',
            'match_details.*.runs' => 'required|integer',
            'match_details.*.hits' => 'required|integer',
            'match_details.*.home_runs' => 'required|integer',
            'match_details.*.strikeouts' => 'required|integer',
            'match_details.*.errors' => 'required|integer',
        ]);

        foreach ($data['match_details'] as $detail) {
            BaseballMatchDetails::create([
                'TeamID' => $detail['team_id'],
                'PlayerID' => $detail['player_id'],
                'Runs' => $detail['runs'],
                'Hits' => $detail['hits'],
                'Home_Runs' => $detail['home_runs'],
                'Strikeouts' => $detail['strikeouts'],
                'Errors' => $detail['errors'],
                'user_id' => auth()->id(), // Ensure user_id is correctly set
            ]);
        }

        return response()->json(['message' => 'Match details submitted successfully!'], 200);
    }


    
}
