<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cuti Karyawan')</title>
    @include('auth/template_auth/styles')
    @stack('styles')
</head>

<body class="bg-primary-subtle">
    @yield('content')
    @include('auth/template_auth/scripts')
    @stack('scripts')
</body>
</html>
