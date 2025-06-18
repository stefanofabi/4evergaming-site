<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="description" content="@yield('description')">
        <link rel="canonical" href="{{ route('index') }}">
        <meta name="robots" content="@yield('robots')">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO Social Media -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="4evergaming: Servidores de Juegos en Argentina" />
        <meta property="og:description" content="Alquiler de Servidores de Juegos. Activación automática. Rápido, simple y seguro." />
        <meta property="og:image" content="{{ asset('images/og-image.png') }}" />
        <meta property="og:url" content="{{ route('index') }}" />
        <meta property="og:locale" content="es_ES" />
        <meta property="og:locale:alternate" content="en_US" />
        <meta property="og:locale:alternate" content="es_ES" />

        <title> @yield('title') </title>

        @vite(['resources/js/app.js'])

        <script type="module">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-WT4PPNWNN5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-WT4PPNWNN5');
        </script>

        <!-- TrustBox script -->
        <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
        <!-- End TrustBox script -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
           
        @section('javascript') @show

        <style>
            html, body {
                font-family: 'Nunito', sans-serif !important;
                background: linear-gradient(135deg, #2b0000, #000000);
                color: #eee !important;
                margin: 0;
                padding: 0;
                min-height: 100vh;
            }

            /* fondo degrade azul
            html, body {
                background: linear-gradient(135deg, #0a1a2b, #000000);
                color: #eee !important;
                margin: 0;
                padding: 0;
                min-height: 100vh;
            }
            */
        </style>

        @section('css') @show
    </head>
    
    <body>
        @include('gametracker.navbar')
        @yield('content') 
    </body>
</html>
