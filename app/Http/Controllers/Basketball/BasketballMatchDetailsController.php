<?php

namespace App\Http\Controllers\Basketball;

use App\Http\Controllers\Controller;
use App\Models\BasketballMatchDetails;
use Illuminate\Http\Request;

class BasketballMatchDetailsController extends Controller
{
    public function index()
    {
        $activeLeague = auth()->user()->leagues()->where('IsActive', true)->first();

        if (!$activeLeague) {
            return response()->json(['error' => 'No active league found.'], 400);
        }

        $BasketballmatchDetails = BasketballMatchDetails::with('player', 'team')
            ->where('LeagueID', $activeLeague->LeagueID) // Filter by active league
            ->get()
            ->map(function ($match) {
                return [
                    'PlayerName' => $match->player->FullName,
                    'TeamName' => $match->team->TeamName,
                    'Points' => $match->Points,
                    'Assists' => $match->Assists,
                    'Rebounds' => $match->Rebounds,
                    'Blocks' => $match->Blocks,
                    'Fouls' => $match->Fouls,
                    'created_at' => $match->created_at,
                ];
            });

        return response()->json($BasketballmatchDetails);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'match_details' => 'required|array',
            'match_details.*.team_id' => 'required|integer',
            'match_details.*.player_id' => 'required|integer',
            'match_details.*.points' => 'required|integer',
            'match_details.*.assists' => 'required|integer',
            'match_details.*.rebounds' => 'required|integer',
            'match_details.*.blocks' => 'required|integer',
            'match_details.*.fouls' => 'required|integer',
        ]);

        $activeLeague = auth()->user()->leagues()->where('IsActive', true)->first();

        if (!$activeLeague) {
            return response()->json(['error' => 'No active league found.'], 400);
        }

        foreach ($data['match_details'] as $detail) {
            BasketballMatchDetails::create([
                'TeamID' => $detail['team_id'],
                'PlayerID' => $detail['player_id'],
                'Points' => $detail['points'],
                'Assists' => $detail['assists'],
                'Rebounds' => $detail['rebounds'],
                'Blocks' => $detail['blocks'],
                'Fouls' => $detail['fouls'],
                'user_id' => auth()->id(),
                'LeagueID' => $activeLeague->LeagueID, // Associate with active league
            ]);
        }

        return response()->json(['message' => 'Match details submitted successfully!'], 200);
    }
}
