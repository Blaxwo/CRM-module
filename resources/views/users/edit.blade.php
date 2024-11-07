@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/edit-user.css') }}">
@endpush

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required
                   maxlength="255" />
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required/>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control"
                   value="{{ old('phone', $user->phone) }}"
                   pattern="^\d{10}$"/>
            @error('phone')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control"
                   minlength="8" />
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="hidden" name="status" value="0">
            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $user->status) ? 'checked' : '' }} />
            @error('status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control"
                   value="{{ old('city', $user->city) }}" />
            @error('city')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    <form id="weather-form" action="{{ route('users.get_weather') }}" method="GET" onsubmit="fetchWeather(event)">
        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Check Weather</button>
        <div id="weather-info" style="margin-top: 20px;"></div>
    </form>

    <script>
        function fetchWeather(event) {
            event.preventDefault();
            const city = document.getElementById('city').value;

            fetch(`{{ route('users.get_weather') }}?city=${city}`)
                .then(response => response.json())
                .then(data => {
                    const weatherInfo = document.getElementById('weather-info');
                    if (data.error) {
                        weatherInfo.innerHTML = `<p class="text-danger">There is no information about the city</p>`;
                    } else {
                        weatherInfo.innerHTML = `<p>Temperature: ${data.temp}°C</p><p>Description: ${data.description}</p>`;
                    }
                })
                .catch(error => console.error('Error fetching weather data:', error));
        }
    </script>
@endsection
