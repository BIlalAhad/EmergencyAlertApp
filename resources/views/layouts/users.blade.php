<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('resources/sass/app.scss') }}">

    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body>
    @php
        $org_id = auth()->user()->organization_id;
    @endphp
    <div id="app">
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
                <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('logo.png') }}" class="h-16" alt=" Logo" />
                    {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ALERT</span> --}}
                </a>
                <div class="flex items-center space-x-6 rtl:space-x-reverse">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-sm text-blue-600 dark:text-blue-500 hover:underline">
                                {{ __('Login') }}
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-sm text-blue-600 dark:text-blue-500 hover:underline">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @else
                        <div class="text-sm text-gray-500 dark:text-white hover:underline">
                            {{ Auth::user()->name }}
                        </div>
                        <a class="btn btn-primary" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        @auth
            <nav class="bg-gray-50 dark:bg-gray-700">
                <div class="max-w-screen-xl px-4 py-3 mx-auto">
                    <div class="flex items-center">
                        <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                            @if (Auth::check() &&
                                    Auth::user()->hasAnyRole(['organization', 'organization member']) &&
                                    !empty(Auth::user()->organization_id))
                                {{-- <li>
                                    <a href="#" class="text-gray-900 dark:text-white hover:underline">Profile</a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('details') }}"
                                        class="text-gray-900 dark:text-white hover:underline">Add details</a>
                                </li>
                                <li>
                                    <a href="{{ route('organizationsview') }}"
                                        class="text-gray-900 dark:text-white hover:underline">View Organization</a>
                                </li>
                                <li>
                                    <a href="{{ route('members', $org_id) }}"
                                        class="text-gray-900 dark:text-white hover:underline">Add members</a>
                                </li>
                                <li>
                                    <a href="{{ route('allmembers') }}"
                                        class="text-gray-900 dark:text-white hover:underline">Members</a>
                                </li>
                                <li>
                                    <a href="{{ route('alerts') }}"
                                        class="text-gray-900 dark:text-white hover:underline">Alerts</a>
                                </li>
                                <li>
                                    <a href="{{ route('about-pages.index', $org_id) }}"
                                        class="text-gray-900 dark:text-white hover:underline">About</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('profile') }}"
                                        class="text-gray-900 dark:text-white hover:underline">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('sended_alerts') }}"
                                        class="text-gray-900 dark:text-white hover:underline">Alerts</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        @endauth

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('resources/js/app.js') }}" defer></script>
</body>

</html>
