<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="description" content="@yield('description')">
        <link rel="canonical" href="{{ route('index') }}">
        <meta name="robots" content="@yield('robots')">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- SEO Social Media -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Servidores de Juegos en Argentina | 4evergaming " />
        <meta property="og:description" content="Alquiler de Servidores de Juegos. Activación automática. Rápido, simple y seguro." />
        <meta property="og:image" content="{{ asset('public/og-image.png') }}" />
        <meta property="og:url" content="{{ route('index') }}" />
        <meta property="og:locale" content="es_ES" />
        <meta property="og:locale:alternate" content="en_US" />
        <meta property="og:locale:alternate" content="es_ES" />

        <title> @yield('title') </title>

        @vite(['resources/js/app.js'])

        @include('tawkto')

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
                
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    
    <body>
        @include('navbar')
        
        @yield('content') 

        @include('footer')
    </body>
</html>
