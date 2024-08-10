    @extends('layouts.users')


    @section('content')
        <style>
            input:active {
                outline: none;
            }

            input:focus {
                outline: none;
            }
        </style>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="container">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user_record as $key => $user)
                        <tr>
                            <th class="" scope="row">{{ $key }}</th>
                            <th>{{ $user->name }}</th>
                            <th>{{ $user->email }}</th>
                            <th>
                                <form action="{{ route('members.store', ['id' => $id, 'user_id' => $user->id]) }}"
                                    method="POST">
                                    @csrf
                                    {{-- <input type="hidden" name="user" value="{{ $user->id }}">
                                <input type="hidden" name="organization" value="{{ $id }}"> --}}
                                    <button type="submit">Add</button>
                                </form>

                            </th>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{ $user_record->links() }}
    @endsection
