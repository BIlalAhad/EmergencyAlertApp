@extends('layouts.app')


@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-6">
                <h2 class="h2">Show Organization</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary" href="{{ route('organizations.index') }}">Back</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="mb-2">
                    <strong class="d-block">Name:</strong>
                    <p class="mb-0">{{ $organization->name }}</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-2">
                    <strong class="d-block">Email:</strong>
                    <p class="mb-0">{{ $organization->email }}</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-2">
                    <strong class="d-block">Phone:</strong>
                    <p class="mb-0">{{ $organization->phone }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
