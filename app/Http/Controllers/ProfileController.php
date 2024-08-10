<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ProfileDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id' , $user_id)->get();
        return view('profile.index' , $profile);
    }

    public function edit()
    {
        $profile = Auth::user()->profile;

        return view('profile.edit', compact('profile'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'profile_picture' => 'nullable|string|max:255',
        ]);
        $profile = Auth::user()->profile;
        $profile->update($request->all());

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }


    public function edit_profile(){
        return view('profile.edit');
    }


    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

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
        $profileDetails->phone = $validatedData['phone'];
        $profileDetails->address = $validatedData['address'];
        $profileDetails->dob = $validatedData['dob'];
        $profileDetails->gender = $validatedData['gender'];
        $profileDetails->bio = $validatedData['bio'];
        $profileDetails->facebook = $validatedData['facebook'];
        $profileDetails->twitter = $validatedData['twitter'];
        $profileDetails->linkedin = $validatedData['linkedin'];

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $profileDetails->profile_image = $imagePath;
        }

        $user->profileDetails()->save($profileDetails);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

}