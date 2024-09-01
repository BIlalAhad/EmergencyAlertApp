<?php

namespace App\Http\Controllers\API\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'organization_id' => 'sometimes|nullable|integer|exists:organizations,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Prepare user data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        // Add organization_id if present
        if ($request->has('organization_id')) {
            $userData['organization_id'] = $request->organization_id;
        }

        // Create the user
        $user = User::create($userData);

        // Assign role
        $user->assignRole('user');

        // Return success response
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
   
            // return $this->sendResponse($success, 'User login successfully.');
            return response()->json(['message' => 'User login successfully.', 'user' => $success], 201);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }


    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        // dd($request->email);
        $userEmail = User::where('email', $request->email)->first();
        if (!empty($userEmail->email)) {

            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status == Password::RESET_LINK_SENT) {
                return response()->json(['message' => 'Reset link has been sent to your email.'], 200);
                // return back()->with('status', __($status));
            }

            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        } else {
            return response()->json(['message' => 'Email not found.'], 404);
        }
    }


    


    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Revoke the token that was used to authenticate the current request
        $user->currentAccessToken()->delete();

        // Return a success response
        return $response()->json('User logged out successfully.');
    }


    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048', // 2MB max size
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'bio' => 'nullable|string|max:500',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        // Update user's basic info
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        // Update or create profile details
        $profileDetails = $user->profileDetails ?: new ProfileDetail();
        $profileDetails->phone = $validatedData['phone'] ?? $profileDetails->phone;
        $profileDetails->address = $validatedData['address'] ?? $profileDetails->address;
        $profileDetails->dob = $validatedData['dob'] ?? $profileDetails->dob;
        $profileDetails->gender = $validatedData['gender'] ?? $profileDetails->gender;
        $profileDetails->bio = $validatedData['bio'] ?? $profileDetails->bio;
        $profileDetails->facebook = $validatedData['facebook'] ?? $profileDetails->facebook;
        $profileDetails->twitter = $validatedData['twitter'] ?? $profileDetails->twitter;
        $profileDetails->linkedin = $validatedData['linkedin'] ?? $profileDetails->linkedin;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $profileDetails->profile_image = $imagePath;
        }

        $user->profileDetails()->save($profileDetails);

        return response()->json(['success' => 'Profile updated successfully.'], 200);
    }
    
}