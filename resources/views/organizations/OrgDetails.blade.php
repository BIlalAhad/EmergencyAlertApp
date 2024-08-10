@if (Auth::user() && Auth::user()->hasRole('Admin'))
@endif

@if (Auth::user() && Auth::user()->hasRole(['organization', 'organization member']))
@endif
