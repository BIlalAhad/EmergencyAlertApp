@extends('layouts.users')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form class="" action="{{ route('alert.store', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 mt-2">
                <label for="inputCity">City</label>
                <input type="text" name="city" class="form-control mt-1" id="inputCity">
            </div>
            <div class="form-group col-md-2 mt-2">
                <label for="inputZip">Zip</label>
                <input type="text" name="zip" class="form-control mt-1" id="inputZip">
            </div>
        </div>
        <div class="form-group col-md-6 mt-2">
            <label for="inputCity">CNIC</label>
            <input type="file" name="CNIC" class="form-control mt-1" id="inputCity">
        </div>
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="submit" class="btn btn-primary mt-3">send</button>
    </form>

    <script src="{{ mix('js/app.js') }}"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = {
                enableHighAccuracy: true,
                timeout: 10000,
            };
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            } else {
                alert("Geolocation is not supported by this browser.");
            }

            // Add an event listener to the form submit event

            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const latitude = document.getElementById('latitude').value;
                const longitude = document.getElementById('longitude').value;

                // If latitude and longitude are not set, prevent form submission
                if (!latitude || !longitude) {
                    event.preventDefault();
                    alert("Geolocation data is not available. Please allow location access.");
                }
            });
        });

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Set the latitude and longitude values in the hidden input fields
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            console.log("Latitude: " + latitude + ", Longitude: " + longitude);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            };

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            } else {
                alert("Geolocation is not supported by this browser.");
            }

            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const latitude = document.getElementById('latitude').value;
                const longitude = document.getElementById('longitude').value;

                if (!latitude || !longitude) {
                    event.preventDefault();
                    alert("Geolocation data is not available. Please allow location access.");
                }
            });
        });

        function showPosition(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            const accuracy = position.coords.accuracy;

            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            console.log(`Latitude: ${latitude}, Longitude: ${longitude}, Accuracy: ${accuracy} meters`);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
            console.error(`Geolocation error: ${error.message} (Code: ${error.code})`);
        }
    </script>
@endsection
