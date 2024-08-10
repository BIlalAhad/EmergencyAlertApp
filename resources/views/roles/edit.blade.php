@extends('layouts.app')


@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-6">
                <h2>Edit Role</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
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

        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="form-floating">
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'id' => 'role-name']) !!}
                    <label for="role-name">Name</label>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    <div class="form-check">
                        @foreach ($permission as $value)
                            <div class="form-check">
                                {!! Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), [
                                    'class' => 'form-check-input',
                                    'id' => 'permission-' . $value->id,
                                ]) !!}
                                <label class="form-check-label" for="permission-{{ $value->id }}">
                                    {{ $value->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>



@endsection
