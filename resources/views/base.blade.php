<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="description" content="@yield('description')">
        <link rel="canonical" href="{{ route('index') }}">
        <meta name="robots" content="@yield('robots')">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO Social Media -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Servidores de Juegos en Argentina | 4evergaming " />
        <meta property="og:description" content="Alquiler de Servidores de Juegos. Activación automática. Rápido, simple y seguro." />
        <meta property="og:image" content="{{ asset('images/og-image.png') }}" />
        <meta property="og:url" content="{{ route('index') }}" />
        <meta property="og:locale" content="es_ES" />
        <meta property="og:locale:alternate" content="en_US" />
        <meta property="og:locale:alternate" content="es_ES" />

        <title> @yield('title') </title>

        @vite(['resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      
            $( document ).ready(function() {
                $.ajax({
                    url: "{{ route('api/ping/gameservers') }}",
                    type: 'post',
                    error: function (xhr, status) {
                        $("#statusServer").removeClass("text-success");
                        $("#statusServer").addClass("text-danger");
                        $("#ping-gameservers").html('Desconectado');
                    },
                    success: function (response) {
                        $("#ping-gameservers").html("En línea ("+response+")");
                    }
                });
            });
        </script>
        
        @include('tawkto')

        @section('javascript') @show

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
