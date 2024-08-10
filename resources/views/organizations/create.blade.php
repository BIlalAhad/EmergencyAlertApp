@extends('layouts.app')


@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-6">
                <h2>Add New Organization</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary" href="{{ route('organizations.index') }}">Back</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="" action="{{ route('organizations.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="form-floating">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                        <label for="phone">Phone</label>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>




@endsection
