<!DOCTYPE html>
<html lang="pt" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://d3js.org/d3.v7.min.js"></script>

    <script src="https://unpkg.com/cal-heatmap/dist/cal-heatmap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/cal-heatmap/dist/cal-heatmap.css">
</head>

<body class="bg-body-tertiary">
    <x-navbar />

    <main class="container mt-5 pb-3">
        {{ $slot }}
    </main>
</body>

</html>
