@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left">
                <h2 class="h2 font-weight-bold  my-4">Organizations</h2>
            </div>
            <div class="pull-right">
                @can('organization-create')
                    <a class="btn btn-success" href="{{ route('organizations.create') }}"> Create New Organization</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>email</th>
            <th>phone</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($organizations as $organization)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $organization->name }}</td>
                <td>{{ $organization->email }}</td>
                <td>{{ $organization->phone }}</td>
                <td>
                    <form class="space-y-1  gap-1" action="{{ route('organizations.destroy', $organization->id) }}"
                        method="POST">
                        <a class="btn btn-info" href="{{ route('details', $organization->id) }}">Add details</a>
                        <a class="btn btn-info" href="{{ route('members', $organization->id) }}">Add members</a>
                        <a class="btn btn-info" href="{{ route('showOrgMembers', $organization->id) }}">show members</a>
                        <a class="btn btn-info" href="{{ route('organizationAlerts', $organization->id) }}">Alerts</a>
                        <a class="btn btn-info" href="{{ url('about-page', $organization->id) }}">About</a>
                        <a class="btn btn-info" href="{{ route('organizations.show', $organization->id) }}">Show</a>
                        @can('organization-edit')
                            <a class="btn btn-primary" href="{{ route('organizations.edit', $organization->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('organization-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {!! $organizations->links() !!}
@endsection
