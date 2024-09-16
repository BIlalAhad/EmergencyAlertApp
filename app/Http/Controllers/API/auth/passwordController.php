<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
// use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class passwordController extends Controller
{
    public function reset_password(Request $request)
{
    // Validate the request data
    $request->validate([
        'email' => 'required|email',
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);
    
    // Find the user by email
    $user = User::where('email', $request->email)->first();
    
    // Check if user exists
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
    
    // Check if the password is already the same (optional)
    // if (Hash::check($request->password, $user->password)) {
    //     return response()->json(['error' => 'New password cannot be the same as the old password'], 400);
    // }
    
    // Hash the new password and save
    $user->password = Hash::make($request->password);
    $user->save();
    
    // Return a success response
    return response()->json(['success' => 'Password reset successfully'], 200);
}

}