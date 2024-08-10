@extends('layouts.users')
@section('content')
    @php
        $user = Auth::user();
    @endphp
    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl font-bold mb-4">{{ $user->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $user->email }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="font-bold">Phone:</p>
                        <p>{{ $user->profileDetails->phone ?? '-' }}</p>
                    </div>
                    <div>
                        {{-- {{ dd($user->profileDetails) }} --}}
                        <p class="font-bold">Address:</p>
                        <p>{{ $user->profileDetails->address ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Date of Birth:</p>
                        <p>
                            {{ $user->profileDetails && $user->profileDetails->dob
                                ? \Carbon\Carbon::parse($user->profileDetails->dob)->format('M d, Y')
                                : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="font-bold">Gender:</p>
                        <p>
                            {{ $user->profileDetails && $user->profileDetails->gender ? ucfirst($user->profileDetails->gender) : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="font-bold">Bio:</p>
                        <p>{{ $user->profileDetails->bio ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Facebook:</p>
                        <p>{{ $user->profileDetails->facebook ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Twitter:</p>
                        <p>{{ $user->profileDetails->twitter ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="font-bold">LinkedIn:</p>
                        <p>{{ $user->profileDetails->linkedin ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('edit_profile') }}" class="text-blue-500 hover:underline">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
