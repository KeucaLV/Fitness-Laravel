<?php

use App\Models\MealPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class)->in('Feature');

it('returns that key 44 is for dinner', function () {

    $response = Http::get('http://127.0.0.1:8000/api/meal-plans');
//    dd($response->json(44)["meal_time"]);
    expect($response->json(44)["meal_time"])->toEqual("dinner");  // Expecting 3 breakfast meals
});
