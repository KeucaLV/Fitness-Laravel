<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validateData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:lietotajs,email|max:255',
                'username' => 'required|string|unique:lietotajs,username|max:255',
                'password' => 'required|string|min:6'
            ]);

            // Create a new user after validation passes
            $user = Lietotajs::create([
                'firstname' => $validateData['firstname'],
                'lastname' => $validateData['lastname'],
                'email' => $validateData['email'],
                'username' => $validateData['username'],
                'password' => Hash::make($validateData['password']),
            ]);

            // Save the user and return a success response
            $user->save();

            return response()->json(['message' => 'Registration successful'], 201);

        } catch (ValidationException $e) {
            // Catch validation exceptions and return errors for frontend
            return response()->json([
                'message' => 'This email or username is already in use!'  // Return detailed validation errors
            ], 422);
        }
    }
}
