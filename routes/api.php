<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InsertWorkoutController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\GymDataController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [RegisterController::class, 'store']);
Route::get('/lietotajs', [AuthController::class, 'lietotajs'])->middleware('auth:sanctum');

Route::get('/lietotajs', [UserController::class, 'getUser']);

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::post('/insertWorkout', [InsertWorkoutController::class, 'store']);

Route::get('/meal-plans', [MealPlanController::class, 'getMealPlans']);


Route::middleware(['auth:sanctum', 'log.auth.header'])->group(function () {
    Route::get('/gym-data', [GymDataController::class, 'index']);
    Route::post('/gym-data', [GymDataController::class, 'store']);
});



