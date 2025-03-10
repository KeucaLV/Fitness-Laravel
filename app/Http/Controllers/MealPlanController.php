<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealPlan;

class MealPlanController extends Controller
{
    /**
     * Get meal plans based on category and meal time.
     */
    public function getMealPlans(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate the request input
        $request->validate([
            'category' => 'nullable|in:weight loss,weight maintenance,weight gain',
            'meal_time' => 'nullable|in:breakfast,lunch,dinner',
        ]);

        // Query to get meal plans
        $mealPlans = MealPlan::query();

        // Filter by category if provided
        if ($request->has('category')) {
            $mealPlans->where('category', $request->input('category'));
        }

        // Filter by meal time if provided
        if ($request->has('meal_time')) {
            $mealPlans->where('meal_time', $request->input('meal_time'));
        }

        // Get the results
        $results = $mealPlans->get();

        // Return the meal plans as a JSON response
        return response()->json($results);
    }
}
