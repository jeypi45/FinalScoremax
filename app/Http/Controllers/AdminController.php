<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User; // Import the User model

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::where('usertype', 'user')->get();

        return Inertia::render('admin/dashboard', [
            'users' => $users,
        ]);
    }
    public function destroy($id)
{
    $user = User::findOrFail($id); // Find the user
    $user->delete(); // Delete the user

    return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
}

}
