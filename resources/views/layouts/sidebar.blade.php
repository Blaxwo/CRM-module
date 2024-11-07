@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

<div class="sidebar">
    <a class="menu" href="{{ route('users.index') }}">Users</a>
</div>
