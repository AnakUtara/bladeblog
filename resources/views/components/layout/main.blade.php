<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>BladeBlog</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overscroll-none">
    <x-ui.navbar />
    @if (session()->has('success'))
        <x-ui.alert message="{{ session('success') }}" />
    @elseif (session()->has('error'))
        <x-ui.alert color="red" message="{{ session('error') }}" />
    @endif
    {{ $slot }}
</body>

<x-ui.footer />

</html>
