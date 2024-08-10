@extends('layouts.users')
@section('content')
    <script src='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css' rel='stylesheet' />
    @php
        $success = Session::get('success');
        $error = Session::get('error');
    @endphp
    <p>{{ $success ? $success : $error }}</p>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Address</th>
            <th>ZIP</th>
            <th>CNIC</th>
            <th>Location</th>
            <th>City</th>
            {{-- <th width="280px">Action</th> --}}
        </tr>
        @foreach ($record as $i => $alert)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $alert->address }}</td>
                <td>{{ $alert->ZIP }}</td>
                <td><img class="" width="120px" height="100px" src="{{ Storage::url($alert->CNIC) }}" alt="CNIC Image">
                </td>
                <td>
                    <div id='map-{{ $i }}' style='width: 150px; height: 100px;'></div>
                    <script>
                        mapboxgl.accessToken =
                            'pk.eyJ1IjoiZGV2d2FsZWVkIiwiYSI6ImNrc3lyNGxrZzJuMDQyeG4xM3llaW9zcjMifQ.7T5nB_o9XT8Qc8lHKuAiQA';
                        const map{{ $i }} = new mapboxgl.Map({
                            container: 'map-{{ $i }}', // Unique container ID for each map
                            style: 'mapbox://styles/mapbox/streets-v12', // Style URL
                            center: [{{ $alert->longitude }}, {{ $alert->latitude }}], // Starting position [lng, lat]
                            zoom: 9, // Starting zoom
                        });
                        const marker{{ $i }} = new mapboxgl.Marker()
                            .setLngLat([{{ $alert->longitude }}, {{ $alert->latitude }}])
                            .addTo(map{{ $i }});
                    </script>
                </td>
                <td>{{ $alert->city }}</td>

            </tr>
        @endforeach
    </table>
@endsection
