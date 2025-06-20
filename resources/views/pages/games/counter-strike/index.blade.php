@extends('base')

@section('description', 'Hosting Counter-Strike 1.6 en Argentina hasta 1000FPS! Con protección Anticheat y Mitigación DDoS. Activación automática. Servicio personalizable con clicks. Soporte por WhatsApp los 365 días del año.')

@section('robots', 'index, follow')

@section('title')
4evergaming: Hosting de Counter-Strike 1.6 en Argentina desde ${{ $slot_300fps_price->first()->monthly }} al mes
@endsection

@section('css')
<style>
    .game-header-image-full {
        width: 100%;
        height: 151px;
    }

    .game-description-snippet {
        margin-top: 10px;
        max-height: 111px;
        overflow: hidden;
        //font-size: 13px;
        line-height: 18px;
        padding-right: 16px;
    }

    .carousel-slides {
        width: 100%;
        height: 400px;
    }

    .latency-image {
        position: relative;
        background-color: transparent;
        background-image: url("{{ asset('images/games/counter-strike/counter-strike-latency.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: 75% 25%;
        opacity: 0.90;
        height: 250px;
    }

    .latency-image::before {
        position: absolute;
        content: '';
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0,0,0, 0.6);
    }

    .text-latency {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: white;
        transform: translate(-50%,-50%);
        //-ms-transform: translate(-50%,-50%);
    }

    .payment-method-large {
        width: 160px;
        height: 60px;
    }

    .payment-method-narrow {
        width: 80px;
        height: 120px;
    }
</style>
@endsection

@section('content')
<div class="container mt-3">
    <!-- 
    <div class="d-none d-md-block"> Todos los juegos > Shooters > Counter-Strike </div>
    -->
    
    <h1 class="d-none d-md-block mt-2"> Counter-Strike 1.6 </h1>

    <div class="row">
        <div class="col-md-8 d-none d-lg-block">   
            @include('pages.games.counter-strike.carousel-slides')
        </div>

        <div class="col">
            <img loading="lazy" class="game-header-image-full" src="{{ asset('images/games/counter-strike/official-banner-counter-strike16.jpg') }}" alt="Logo oficial de Counter-Strike 1.6" title="El Logo Oficial de Counter-Strike 1.6">
            <h1 class="d-block d-md-none mt-2"> Counter-Strike 1.6 </h1>

            <p class="game-description-snippet"> Disfruta del juego de acción en línea n° 1 en el mundo. Sumérgete en el fragor de la guerra antiterrorista más realista con este archiconocido juego por equipos. Alíate con compañeros para superar misiones estratégicas, asalta bases enemigas, rescata rehenes, y recuerda que tu personaje contribuye al éxito del equipo...</p>							
            
            @include('pages.games.counter-strike.qualification-service')
            
            @include('pages.games.counter-strike.service-labels')
        </div>
    </div>

    @include('pages.games.counter-strike.national-latency')
    
    @include('pages.games.counter-strike.server-information')

    @include('pages.games.counter-strike.characteristics-servers')

    <div class="mt-3">
        @include('pages.games.counter-strike.plans.1000fps')
    </div>

    <div class="row mt-4">
        <div class="col-md">
            @include('pages.games.counter-strike.what-are-fps-server')
        </div>

        <div class="col">
            @include('pages.games.counter-strike.contact-by-whatsapp')
        </div>
    </div>

    <div class="d-lg-none">
        @include('pages.games.counter-strike.contact-by-whatsapp')
    </div>
    
    @include('pages.games.counter-strike.frequently-questions')
</div>

@include('modals/ixp-points')


@endsection