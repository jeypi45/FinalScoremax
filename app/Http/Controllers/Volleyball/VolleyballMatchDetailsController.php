<?php

namespace App\Http\Controllers\Volleyball;
use App\Http\Controllers\Controller;


use App\Models\VolleyballMatchDetails;
use Illuminate\Http\Request;


class VolleyballMatchDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // In VolleyballMatchDetailsController.php
    public function index()
    {
        $VolleyballmatchDetails = VolleyballMatchDetails::with('player', 'team') // Ensure the relationships are loaded
            ->get()
            ->map(function ($match) {
                return [
                    'PlayerName' => $match->player->FullName, // Assuming the relationship is named 'player'
                    'TeamName' => $match->team->TeamName, // Assuming the relationship is named 'team'
                    'Kills' => $match->Kills,
                    'Aces' => $match->Aces,
                    'Digs' => $match->Digs,
                    'Blocks' => $match->Blocks,
                    'Service_Errors' => $match->Service_Errors,
                    'created_at' => $match->created_at,
                ];
            });
    
        return response()->json($VolleyballmatchDetails);
    }


     public function store(Request $request)
    {
        $data = $request->validate([
            'match_details' => 'required|array',
            'match_details.*.team_id' => 'required|integer',
            'match_details.*.player_id' => 'required|integer',
            'match_details.*.kills' => 'required|integer',
            'match_details.*.aces' => 'required|integer',
            'match_details.*.digs' => 'required|integer',
            'match_details.*.blocks' => 'required|integer',
            'match_details.*.service_errors' => 'required|integer',
        ]);

        foreach ($data['match_details'] as $detail) {
            VolleyballMatchDetails::create([
                'TeamID' => $detail['team_id'],
                'PlayerID' => $detail['player_id'],
                'Kills' => $detail['kills'],
                'Aces' => $detail['aces'],
                'Digs' => $detail['digs'],
                'Blocks' => $detail['blocks'],
                'Service_Errors' => $detail['service_errors'],
                'user_id' => auth()->id(), // Ensure user_id is correctly set
            ]);
        }

        return response()->json(['message' => 'Match details submitted successfully!'], 200);
    }

 
     

    /**
     * Display the specified resource.
     */
    public function show(VolleyballMatchDetails $volleyballMatchDetails)
    {
        
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VolleyballMatchDetails $volleyballMatchDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VolleyballMatchDetails $volleyballMatchDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VolleyballMatchDetails $volleyballMatchDetails)
    {
        //
    }
    
}
