@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex flex-col h-full w-full mx-auto  space-y-6">
            <section class="flex flex-col mx-auto bg-white rounded-lg p-6  space-y-6 w-full">


                <div class="grid grid-cols-3 gap-2">
                    <!-- In use -->
                    <div class="flex flex-col px-6 py-2 bg-white shadow rounded-lg overflow-hidden">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="text-6xl font-bold tracking-tight leading-none text-blue-500">{{ $organization }}
                            </div>
                            <div class="text-lg font-medium text-blue-500">ORGANIZATIONS</div>
                        </div>
                    </div>
                    <!-- renovation -->
                    <div class="flex flex-col px-6 py-2 bg-white shadow rounded-lg overflow-hidden">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="text-6xl font-bold tracking-tight leading-none text-amber-500">{{ $Users }}
                            </div>
                            <div class="text-lg font-medium text-amber-600">USERS</div>
                        </div>
                    </div>
                    <!-- Suspended -->
                    <div class="flex flex-col px-6 py-2 bg-white shadow rounded-lg overflow-hidden">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="text-6xl font-bold tracking-tight leading-none text-red-500">{{ $alerts }}
                            </div>
                            <div class="text-lg font-medium text-red-600">ALERTS</div>
                        </div>
                    </div>
                    <!-- Closed -->
                    {{-- <div class="flex flex-col px-6 py-2 bg-white shadow rounded-lg overflow-hidden">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="text-6xl font-bold tracking-tight leading-none text-primary-900">38
                            </div>
                            <div class="text-lg font-medium text-primary-900">Closed</div>
                        </div>
                    </div> --}}
                </div>
            </section>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

        </div>
    </div>
@endsection
