<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Profedex') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Boogaloo&display=swap">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <script src="https://unpkg.com/wavesurfer.js@7"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        .font-boogaloo {
            font-family: 'Boogaloo', cursive;
        }

        .preload {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #29002b;
        }

        ::-webkit-scrollbar-thumb {
            background: #2e16ca;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6251d1;
        }
    </style>
</head>

<body class="bg-teal-600 preload">
    <div class="min-h-screen">
        <!-- Page Content -->
        <main class="">
            {{ $slot }}
        </main>

    </div>
    @livewireScripts
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.classList.remove("preload");
        });
    </script>
</body>

</html>
