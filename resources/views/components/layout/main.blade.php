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

    @auth
        <div data-username="{{ auth()->user()->username }}" data-avatar="{{ auth()->user()->avatar }}" id="chat-wrapper"
            class="shadow chat-wrapper border-top border-left border-right"></div>
    @endauth

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        $('[data-toggle="tooltip"]').tooltip()
    </script>

</body>

<x-ui.footer />

</html>
