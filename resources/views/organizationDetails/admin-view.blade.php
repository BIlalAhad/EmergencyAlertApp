@php
    $id = request()->segment(2);
@endphp
@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="post" action="{{ route('submitDetails', $id) }}">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="DateOfEstablishment" id="dateOfEstablishment"
                            placeholder="Date Of Establishment" required>
                        <label for="dateOfEstablishment">Date Of Establishment</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="RegistrationNumber" class="form-control" id="registrationNumber"
                            placeholder="Registration Number" required>
                        <label for="registrationNumber">Registration Number</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" name="HeadquartersAddress" id="headquartersAddress"
                        placeholder="Headquarters Address" required>
                    <label for="headquartersAddress">Headquarters Address</label>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <input type="url" class="form-control" name="WebsiteURL" id="websiteURL" placeholder="Website URL"
                        required>
                    <label for="websiteURL">Website URL</label>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <input type="number" class="form-control" name="NumberOfEmployees" id="numberOfEmployees"
                        placeholder="Number Of Employees" required>
                    <label for="numberOfEmployees">Number Of Employees</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
