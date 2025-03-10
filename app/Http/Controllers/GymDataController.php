<?php

// app/Http/Controllers/GymDataController.php
namespace App\Http\Controllers;

use App\Models\GymData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymDataController extends Controller
{
    // Fetch gym data for the authenticated user, grouped by date
    public function index()
    {
        $gymData = GymData::where('user_id', Auth::id())->get()->groupBy('date');
        return response()->json($gymData);
    }

    // Store new gym data for the authenticated user
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
        ]);


        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }

        $gymData = GymData::create([
            'user_id' => $userId,
            'date' => $request->date,
            'name' => $request->name,
            'duration' => $request->duration,
            'description' => $request->description,
        ]);

        return response()->json($gymData, 201);
    }

}
