<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen">
    <section class="w-full min-h-screen px-3 antialiased bg-gradient-to-br from-gray-900 via-black to-gray-800 lg:px-6">
        <div class="mx-auto max-w-7xl min-h-screen flex flex-col">
            <x-navbar />

            <main class="container px-6 py-8 mx-auto md:text-center md:px-4 flex-grow">
                {{ $slot }}
            </main>
        </div>
    </section>

    @livewireScripts
</body>

</html>