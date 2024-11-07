@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create-user.css') }}">
@endpush

@section('content')
    <h1>Create User</h1>
    <form action="{{ route('users.add') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" required maxlength="255" />
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" pattern="^\d{10}$" />
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="password" id="password" class="form-control" minlength="8" required />
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control" placeholder="City" maxlength="255" />
            @error('city')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="hidden" name="status" value="0">
            <input type="checkbox" name="status" id="status" value="1" checked />
            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add New User</button>
    </form>
@endsection
