@extends('layouts.app')


@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-6">
                <h2>Edit New User</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'id' => 'name']) !!}
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email']) !!}
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'id' => 'password']) !!}
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    {!! Form::password('confirm-password', [
                        'placeholder' => 'Confirm Password',
                        'class' => 'form-control',
                        'id' => 'confirm-password',
                    ]) !!}
                    <label for="confirm-password">Confirm Password</label>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-select', 'multiple']) !!}
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>



@endsection
