<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tec de Motul</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&family=Tangerine&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .imagendefondo {
            background-image: url('https://lh3.googleusercontent.com/pw/AJFCJaUcPXmE1MqDs9KEBSS3PV29mYU1KSJevP6Gb3LIghdCkZijdfvo48sZKbpZ0IKgOEtutDrkp-35S2_nR75JAIenIrP_PFiY7acX1pPeOlONnnzhG49gf52bekq1-j1e4Cxh0JAcXxP-tv_pUCQ2v1y5=w1760-h990-s-no?authuser=0');
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="imagendefondo">
    <div class="container">
        <!-- Page Content goes here -->
        <br><br><br><br><br><br><br>
        <div class="row py-12">
            <div class="py-12 px-4 align-items: center">
                <div class="col s12">
                    <div class="row">
                        <div class="col s5"></div>
                        <div class="col s2">
                            <div class="border-4 border-black py-2 px-2 rounded-[30px] shadow-lg">
                                <br>
                                <br>
                                LOOGO
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="col s5"></div>
                    </div>

                </div>
                <div class="col s12">
                    <div class="row">
                        <div class="col s3"></div>
                        <div class="col s6">
                            <div class="border-4 border-black py-2 px-2 rounded-[30px] shadow-lg">
                                <div class="rounded-[30px] overflow-hidden shadow-lg py-4 bg-[#cbd5e1] opacity-70 border-4 border-black">
                                    <div class="px-6 py-4">
                                        <div class="font-bold text-6xl mb-2 text-[#b91c1c] "><a href="{{ url('/login') }}">INICIA TU SESIÓN</a></div>
                                        <p class="text-lg py-4">
                                            <button class="bg-[#5b21b6] hover:bg-blue-700 text-[#fde047] font-bold py-2 px-4 rounded">
                                                <a href="{{ url('/register') }}">REGISTRATE</a>
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>