<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-body-tertiary">
    <x-navbar></x-navbar>

    <main class="container mt-5">
        {{ $slot }}
    </main>
    @livewireScripts
</body>

</html>
