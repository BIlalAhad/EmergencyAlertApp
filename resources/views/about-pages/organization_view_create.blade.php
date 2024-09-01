@extends('layouts.users')

@section('content')
    <div class="container">
        {{-- <h1>Create About Page for {{ $organization->name }}</h1> --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('about-pages.store', $organization_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="organization_id" value="{{ $organization_id }}" hidden>

            <div class="form-group mt-2">
                <label for="heading_1">Heading 1</label>
                <input type="text" class="form-control mt-1" id="heading_1" name="heading_1"
                    value="{{ old('heading_1') }}">
            </div>

            <div class="form-group mt-2">
                <label for="image_1">Image 1</label>
                <input type="file" class="form-control mt-1" id="image_1" name="image_1">
            </div>

            <div class="form-group mt-2">
                <label for="paragraph_1">Paragraph 1</label>
                <textarea class="form-control mt-1" id="paragraph_1" name="paragraph_1">{{ old('paragraph_1') }}</textarea>
            </div>

            <div class="form-group mt-2">
                <label for="heading_2">Heading 2</label>
                <input type="text" class="form-control mt-1" id="heading_2" name="heading_2"
                    value="{{ old('heading_2') }}">
            </div>

            <div class="form-group mt-2">
                <label for="image_2">Image 2</label>
                <input type="file" class="form-control mt-1" id="image_2" name="image_2">
            </div>

            <div class="form-group mt-2">
                <label for="paragraph_2">Paragraph 2</label>
                <textarea class="form-control mt-1" id="paragraph_2" name="paragraph_2">{{ old('paragraph_2') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
