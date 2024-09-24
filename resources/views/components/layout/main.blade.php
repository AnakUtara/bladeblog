<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @isset($title)
            {{ $title }} | BladeBlog
        @else
            BladeBlog
        @endisset
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
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
