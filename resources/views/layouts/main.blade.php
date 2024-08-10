<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head content, meta tags, stylesheets -->
</head>

<body>
    <!-- Admin-specific content -->
    @if (Auth::user()->hasRole('Admin'))
        @include('layouts.app')
    @endif

    <!-- Organization-specific content -->
    @if (Auth::user()->hasAnyRole(['organization', 'organization member']) && !empty(Auth::user()->organization_id))
        @include('layouts.users')
    @endif

    <!-- Main content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Scripts -->
</body>

</html>
