@extends('layouts.users')
@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Profile Information</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-bold mb-2">Phone:</label>
                <input type="text" id="phone" name="phone"
                    value="{{ old('phone', auth()->user()->profileDetails->phone ?? '') }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-bold mb-2">Address:</label>
                <input type="text" id="address" name="address"
                    value="{{ old('address', auth()->user()->profileDetails->address ?? '') }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="profile_image" class="block text-gray-700 font-bold mb-2">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('profile_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="dob" class="block text-gray-700 font-bold mb-2">Date of Birth:</label>
                <input type="date" id="dob" name="dob"
                    value="{{ old('dob', auth()->user()->profileDetails->dob ?? '') }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('dob')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-gray-700 font-bold mb-2">Gender:</label>
                <select id="gender" name="gender"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="male"
                        {{ old('gender', auth()->user()->profileDetails->gender ?? '') == 'male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="female"
                        {{ old('gender', auth()->user()->profileDetails->gender ?? '') == 'female' ? 'selected' : '' }}>
                        Female</option>
                    <option value="other"
                        {{ old('gender', auth()->user()->profileDetails->gender ?? '') == 'other' ? 'selected' : '' }}>
                        Other</option>
                </select>
                @error('gender')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-700 font-bold mb-2">Bio:</label>
                <textarea id="bio" name="bio" rows="4"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', auth()->user()->profileDetails->bio ?? '') }}</textarea>
                @error('bio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="facebook" class="block text-gray-700 font-bold mb-2">Facebook:</label>
                <input type="url" id="facebook" name="facebook"
                    value="{{ old('facebook', auth()->user()->profileDetails->facebook ?? '') }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('facebook')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="twitter" class="block text-gray-700 font-bold mb-2">Twitter:</label>
                <input type="url" id="twitter" name="twitter"
                    value="{{ old('twitter', auth()->user()->profileDetails->twitter ?? '') }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('twitter')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="linkedin" class="block text-gray-700 font-bold mb-2">LinkedIn:</label>
                <input type="url" id="linkedin" name="linkedin"
                    value="{{ old('linkedin', auth()->user()->profileDetails->linkedin ?? '') }}"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('linkedin')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Profile
                </button>
                <a href="{{ route('profile') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
