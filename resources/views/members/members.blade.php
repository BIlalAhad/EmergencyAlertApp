@extends('layouts.users')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($organization->users as $i => $user)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('member.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>


    {{-- {!! $organizations->links() !!} --}}
@endsection
