@extends('layouts.users')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Organizations</h2>
            </div>
            <div class="pull-right">
                @can('organization-create')
                    {{-- <a class="btn btn-success" href="{{ route('organizations.create') }}"> Create New Organization</a> --}}
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @php
        $users = $organization->users;
        $details = $organization->organizationdetail;
    @endphp
    @if (!empty($organization))
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>email</th>
                <th>phone</th>
                <th>Date Of Establishment</th>
                <th>R/Number</th>
                <th>Head quarters Address</th>
                <th>WebsiteURL</th>
                <th>Number Of Employees</th>
                <th width="280px">Action</th>
            </tr>


            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $organization->name }}</td>
                <td>{{ $organization->email }}</td>
                <td>{{ $organization->phone }}</td>
                <td> {{ $details && $details->DateOfEstablishment ? $details->DateOfEstablishment : '-' }}</td>
                <td>{{ $details && $details->RegistrationNumber ? $details->RegistrationNumber : '-' }}</td>
                <td>{{ $details && $details->HeadquartersAddress ? $details->HeadquartersAddress : '-' }}</td>
                <td>{{ $details && $details->WebsiteURL ? $details->WebsiteURL : '-' }}</td>
                <td>{{ $details && $details->NumberOfEmployees ? $details->NumberOfEmployees : '-' }}</td>
                <td>
                    {{-- <form action="{{ route('organizationdetail.destroy', $details->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        @can('organization-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form> --}}
                    <form action="{{ route('organizationdetail.destroy', ['id' => $organization->id]) }}" method="POST">
                        @csrf
                        <input type="text" class="d-none" name="id" value="{{ $organization->id }}">
                        {{-- @can('organization-delete') --}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {{-- @endcan --}}
                    </form>

                </td>
            </tr>

        </table>
    @else
        <p>no records</p>
    @endif
@endsection
