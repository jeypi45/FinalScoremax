<?php

// app/Http/Controllers/LeagueController.php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeagueController extends Controller
{
    // Display the dashboard with the active league
    public function dashboard()
    {
        // Get the active league
        $activeLeague = League::where('user_id', Auth::id())->where('IsActive', true)->first();
        
        return response()->json([
            'activeLeague' => $activeLeague
        ]);
    }

    public function index(Request $request)
{
    // Retrieve leagues for the authenticated user
    $leagues = League::where('user_id', $request->user()->id)->get();

    return response()->json(['leagues' => $leagues]);
}



    // Create a new league
    public function store(Request $request)
    {
        $request->validate([
            'LeagueName' => 'required|string|max:255',
            'StartDate' => 'required|date',
            'EndDate' => 'nullable|date|after_or_equal:StartDate',
        ]);

        // End any active leagues
        League::where('user_id', Auth::id())->where('IsActive', true)->update(['IsActive' => false]);

        // Create the new league
        $league = League::create([
            'LeagueName' => $request->LeagueName,
            'StartDate' => $request->StartDate,
            'EndDate' => $request->EndDate,
            'IsActive' => true,
            'user_id' => Auth::id(),
        ]);

        return response()->json($league, 201);
    }

    // End the active league
    public function endActiveLeague()
    {
        $activeLeague = League::where('user_id', Auth::id())->where('IsActive', true)->first();

        if ($activeLeague) {
            $activeLeague->update([
                'IsActive' => false,
                'EndDate' => now(),
            ]);
            return response()->json(['message' => 'Active league ended.']);
        }

        return response()->json(['message' => 'No active league found.'], 404);
    }
    // In your LeagueController.php

    public function setActiveLeague($id)
    {
        $league = League::find($id);
    
        if ($league) {
            $league->IsActive = true;
            $league->save();
    
            return response()->json($league); // Return the updated league
        }
    
        return response()->json(['error' => 'League not found'], 404);
    }
    public function view($id)
{
    $league = League::findOrFail($id);
    return response()->json($league);
}

    

}
