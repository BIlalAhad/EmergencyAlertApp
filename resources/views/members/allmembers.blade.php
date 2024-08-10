@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($organizationMembers as $key => $organization)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $organization->user->name }}</td>
                <td>{{ $organization->user->email }}</td>
                <td>
                    <form action="{{ route('member.destroy', $organization->user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
