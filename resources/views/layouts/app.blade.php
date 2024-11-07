<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRM Module</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @stack('styles')
</head>
<body>
@include('layouts.sidebar')
<div class="content">
    @yield('content')
</div>
</body>
</html>
