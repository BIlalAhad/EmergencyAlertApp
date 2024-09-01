@extends('layouts.users')



@section('content')
    <div class="container mt-4">
        <!-- Success and Error Alerts -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- About Page Content -->
        @if ($about)
            <div class="row mb-4 text-center shadow-sm ">
                <!-- Heading and Content for First Section -->
                <div class="col-md-6  p-3">
                    @if ($about->image_1)
                        <img src="{{ Storage::url($about->image_1) }}" alt="Image 1"
                            class="img-fluid mb-3  w-full h-[200px] object-cover">
                    @endif
                    <h2 class="text-xl font-bold mb-2">{{ $about->heading_1 }}</h2>
                    <p><i>{{ $about->paragraph_1 }}</i></p>
                </div>

                <!-- Heading and Content for Second Section -->
                <div class="col-md-6 justify-center  p-3">
                    @if ($about->image_2)
                        <img src="{{ Storage::url($about->image_2) }}" alt="Image 2"
                            class="img-fluid mb-3  w-full h-[200px] object-cover">
                    @endif
                    <h2 class="text-xl font-bold mb-2">{{ $about->heading_2 }}</h2>
                    <p><i>{{ $about->paragraph_2 }}</i></p>
                </div>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                No about page found. <a href="{{ route('about-pages.create', $organization_id) }}" class="alert-link">Create
                    one now</a>.
            </div>
        @endif

        <!-- Create About Page Button -->
        <a href="{{ route('about-pages.create', $organization_id) }}" class="btn btn-primary mt-3">Create About Page</a>
    </div>


@endsection
