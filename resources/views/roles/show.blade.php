@extends('layouts.app')


@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-6">
                <h2>Show Role</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Role Information</h5>
                        <dl class="row">
                            <dt class="col-sm-3">Name:</dt>
                            <dd class="col-sm-9">{{ $role->name }}</dd>

                            <dt class="col-sm-3">Permissions:</dt>
                            <dd class="col-sm-9">
                                @if (!empty($rolePermissions))
                                    @foreach ($rolePermissions as $v)
                                        <span class="badge bg-success me-1">{{ $v->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No permissions assigned</span>
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
