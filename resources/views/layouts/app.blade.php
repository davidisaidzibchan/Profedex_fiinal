<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&family=Tangerine&display=swap" rel="stylesheet">

    <style>
        .imagendefondo {
            background-image: url('https://lh3.googleusercontent.com/pw/AJFCJaXKrj-3SbJ3n1yhACU1Q1FbkdhuuicmJBUQEYituNM_VJfO-KjfZY5pKv_NekPmcMD9gXI2jo5ha1M7q3MevHGknHKdetSnVwocPN21SUnt0Uep0Z6RzyoAg_XJCiQw09Hl4oDU56r611wYjiqKtH6E=w1760-h990-s-no?authuser=0');
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased imagendefondo ">
    <div class="min-h-screen ">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="shadow bg-[#0f172a]">
            <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 text-center">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>