@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/users-list.css') }}">
@endpush

@section('content')
    <h1>Users List</h1>

    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Filter by name">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">All</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-filter">Filter</button>
    </form>

    @if($users->isEmpty())
        <p>There are no users</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registration Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->registration_date }}</td>
                    <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary btn-create">Create User</a>

    {{ $users->links() }}
@endsection
