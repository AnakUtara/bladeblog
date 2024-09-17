<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <title>BladeBlog</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overscroll-none">
    <x-ui.navbar />
    @if (session()->has('success'))
        <x-ui.toast icon="success" message="{{ session('success') }}" />
    @elseif (session()->has('error'))
        <x-ui.toast icon="error" message="{{ session('error') }}" />
    @endif
    {{ $slot }}
    <x-ui.footer />
</body>

</html>