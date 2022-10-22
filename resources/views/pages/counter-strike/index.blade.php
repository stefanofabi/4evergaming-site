@extends('base')

@section('description', 'Hosting Counter-Strike 1.6 en Argentina hasta 1000FPS! Con protección Anticheat y Mitigación DDoS. Activación automática. Servicio personalizable con clicks. Soporte por WhatsApp los 365 días del año.')

@section('robots', 'index, follow')

@section('title')
4evergaming: Hosting de Counter-Strike 1.6 en Argentina desde ${{ $slot_300fps_price * $dollar_price * 4 }} al mes
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
    background-color: transparent;
    background-image: url("{{ asset('images/games/counter-strike/counter-strike-latency.jpg') }}");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: 75% 25%;
    opacity: 0.95;
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
    <div class="d-none d-md-block"> Todos los juegos > Shooters > Counter-Strike </div>

    <h1 class="d-none d-md-block mt-2"> Counter-Strike 1.6 </h1>

    <div class="row">
        <div class="col-md-8 d-none d-md-block">   
            @include('pages/counter-strike/carousel-slides')
        </div>

        <div class="col">
            <img loading="lazy" class="game-header-image-full" src="{{ asset('images/games/counter-strike/official-banner-counter-strike16.jpg') }}" alt="Logo oficial de Counter-Strike 1.6" title="El Logo Oficial de Counter-Strike 1.6">
            <h1 class="d-block d-sm-none mt-2"> Counter-Strike 1.6 </h1>

            <p class="game-description-snippet"> Disfruta del juego de acción en línea n° 1 en el mundo. Sumérgete en el fragor de la guerra antiterrorista más realista con este archiconocido juego por equipos. Alíate con compañeros para superar misiones estratégicas, asalta bases enemigas, rescata rehenes, y recuerda que tu personaje contribuye al éxito del equipo...</p>							
            
            @include('pages/counter-strike/qualification-service')
            
            @include('pages/counter-strike/service-labels')
        </div>
    </div>

    @include('pages/counter-strike/national-latency')
    
    @include('pages/counter-strike/server-information')

    @include('pages/counter-strike/characteristics-servers')

    <div class="row mt-4">
        <div class="col">
            @include('pages/counter-strike/what-are-fps-server')

            <div class="d-none d-lg-block">
                @include('pages/counter-strike/contact-by-whatsapp')
            </div>
        </div>

        <div class="col-md">
            @include('pages/counter-strike/plan-tabs')
        </div>
    </div>

    <div class="d-lg-none">
        @include('pages/counter-strike/contact-by-whatsapp')
    </div>
    
    @include('pages.counter-strike.frequently-questions')
</div>

@include('modals/ixp-points')


@endsection