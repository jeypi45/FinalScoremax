<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use inertia\Inertia;
use Inertia\Response;

class GreetingsController extends Controller

{
    public function index(): Response
    {
        return Inertia::render("GreetUserForm", [

        ]); // Render the React component
    }

    
    
}
