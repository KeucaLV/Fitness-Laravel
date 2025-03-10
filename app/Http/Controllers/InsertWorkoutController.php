<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsertWorkout;

class InsertWorkoutController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'workout_name' => 'required|string|max:255',
            'duration_hours' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        // Insert the workout into the database
        InsertWorkout::create([
            'workout_name' => $request->input('workout_name'),
            'duration_hours' => $request->input('duration_hours'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['message' => 'Workout created successfully!'], 201);
    }

}
