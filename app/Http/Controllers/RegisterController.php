<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validateData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:lietotajs,email|max:255',
            'username' => 'required|string|unique:lietotajs,username|max:255',
            'password' => 'required|string|min:6',
            'weight_now' => 'required|string',
            'goal_weight' => 'required|string',
            'goal' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate unique image name
            $imagePath = $image->storeAs('public/lietotajs', $imageName); // Save to storage/lietotajs
        }

        // Create a new user after validation passes
        $user = Lietotajs::create([
            'firstname' => $validateData['firstname'],
            'lastname' => $validateData['lastname'],
            'email' => $validateData['email'],
            'username' => $validateData['username'],
            'password' => Hash::make($validateData['password']),
            'weight_now' => $validateData['weight_now'],
            'goal_weight' => $validateData['goal_weight'],
            'goal' => $validateData['goal'],
            'img' => $imagePath ? Storage::url($imagePath) : null, // Store image URL if uploaded
        ]);

        // Save the user and return a success response
        $user->save();

        return response()->json(['message' => 'Registration successful'], 201);
    }
}