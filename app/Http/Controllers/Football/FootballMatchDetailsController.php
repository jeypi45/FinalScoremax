<?php

namespace App\Http\Controllers\Football;
use App\Http\Controllers\Controller;

use App\Models\FootballMatchDetails;
use Illuminate\Http\Request;

class FootballMatchDetailsController extends Controller
{
    public function index()
    {
        $FootballmatchDetails = FootballMatchDetails::with('player', 'team') // Ensure the relationships are loaded
            ->get()
            ->map(function ($match) {
                return [
                    'PlayerName' => $match->player->FullName, // Assuming the relationship is named 'player'
                    'TeamName' => $match->team->TeamName, // Assuming the relationship is named 'team'
                    'Goals' => $match->Goals,
                    'Assists' => $match->Assists,
                    'YellowCard' => $match->YellowCard,
                    'RedCard' => $match->RedCard,
                    'created_at' => $match->created_at,
                ];
            });

        return response()->json($FootballmatchDetails);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'match_details' => 'required|array',
            'match_details.*.team_id' => 'required|integer',
            'match_details.*.player_id' => 'required|integer',
            'match_details.*.goals' => 'required|integer',
            'match_details.*.assists' => 'required|integer',
            'match_details.*.yellowCard' => 'required|integer',
            'match_details.*.redCard' => 'required|integer',
        ]);

        foreach ($data['match_details'] as $detail) {
            FootballMatchDetails::create([
                'TeamID' => $detail['team_id'],
                'PlayerID' => $detail['player_id'],
                'Goals' => $detail['goals'],
                'Assists' => $detail['assists'],
                'YellowCard' => $detail['yellowCard'],
                'RedCard' => $detail['redCard'],
                'user_id' => auth()->id(), // Ensure user_id is correctly set
            ]);
        }

        return response()->json(['message' => 'Match details submitted successfully!'], 200);
    }
}
