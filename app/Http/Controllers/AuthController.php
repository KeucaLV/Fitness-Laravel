<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Lietotajs;

class AuthController extends Controller
{

    public function lietotajs(Request $request)
    {
        return response()->json($request->lietotajs());
    }


    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate login credentials
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:4'
        ]);

        // Find the user by email
        $user = Lietotajs::where('email', $loginUserData['email'])->first();

        // Check for valid user and password
        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        // Create a new token
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;




        // Return the access token and user data
        return response()->json([
            'access_token' => $token,
            'user' => [
                'userId' => $user->id,
                'username' => $user->username, // Assuming 'username' is a field in the 'lietotajs' table
                'email' => $user->email, // Include other fields if necessary
                'img' => $user->img, // Include other fields if necessary
                'goal_weight' => $user->goal_weight, // Include other fields if necessary
                'weight_now' => $user->weight_now, // Include other fields if necessary
                // Add more fields as needed, but avoid sensitive data like password
            ],
        ]);


    }
}
