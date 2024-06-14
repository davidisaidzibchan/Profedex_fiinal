<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bad Gateway</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .background-image {
            background-image: url('/img/fondo.png');
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen flex items-center justify-center background-image bg-cover bg-center">
    <div class="fixed bg-black/50 w-full h-full inset-0 flex justify-center items-center">
        <div class=" bg-pink-600/80 text-white p-8 rounded-lg text-center">
            <h1 class="text-5xl mb-4 font-extrabold">502</h1>
            <p class="text-xl mb-6 font-extrabold">Bad Gateway.</p>
            <a href="{{ url('/') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded">Volver al inicio</a>
        </div>
    </div>
</body>

</html>
