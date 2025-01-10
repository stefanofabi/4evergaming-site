@extends('base')

@section('description')
¿Competitivo 5v5? ¿Práctica? ¿DM? ¿Retakes? ¿Duelos 1v1? ¿KZ? ¿Surf? ¡Puedes hacerlo todo con un solo clic! ¡Consigue tu servidor CS:GO hoy desde ${{ $slot_64tickrate_price * $dollar_price * 4 }}/mes! Garantía de reembolso.
@endsection

@section('robots', 'index, follow')

@section('title')
4evergaming: Hosting de Counter-Strike: Global Offensive en Argentina desde ${{ $slot_64tickrate_price * $dollar_price * 4 }} al mes
@endsection

@section('css')
<style>
  .overlay {
    position: relative;
    background-color: transparent;
    background-image: url("{{ asset('images/games/counter-strike-global-offensive/counter-strike-global-offensive-header.jpg') }}");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: top;
    opacity: 0.95;
    height: 100vh;
  }

  .overlay::before {
    position: absolute;
    content: '';
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0,0,0, 0.6);
  }

  .text{
    position: absolute;
    width: 100%;
    top: 50%;
    left: 50%;
    font-size: 50px;
    color: white;
    transform: translate(-50%,-50%);
    //-ms-transform: translate(-50%,-50%);
  }

  .carousel-slides {
    width: 100%;
	  height: 400px;
  }

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
</style>
@endsection

@section('content')
@include('pages.games.counter-strike-global-offensive.header')

<div class="container mt-3">
  <!-- 
  <div class="d-none d-md-block"> Todos los juegos > Shooters > Counter-Strike: Global Offensive </div>
  -->
  
  <h1 class="mt-2 d-none d-md-block"> Counter-Strike: Global Offensive </h1> 
  
  <div class="row">
    <div class="col-md-8 d-none d-lg-block">
      @include('pages.games.counter-strike-global-offensive.carousel-slides')
    </div> 

    <div class="col">
      <img loading="lazy" class="game-header-image-full" src="{{ asset('images/games/counter-strike-global-offensive/counter-strike-global-offensive-banner.jpg') }}" alt="Banner Oficial de Counter-Strike: Global Offensive" title="El banner Oficial de Counter-Strike: Global Offensive">
      <h1 class="mt-2 d-md-none"> Counter-Strike: Global Offensive </h1>       
      <p class="game-description-snippet"> Counter-Strike: Global Offensive (CS:GO) amplía el juego de acción por equipos del que fue pionero cuando salió hace más de 20 años. CS:GO incluye nuevos mapas, personajes, armas y modos de juego, y ofrece versiones actualizadas del contenido clásico de Counter-Strike (de_dust2, etc.).
    
      @include('pages.games.counter-strike-global-offensive.qualification-service')
                
      @include('pages.games.counter-strike-global-offensive.service-labels')
    </div>
  </div>

  @include('pages.games.counter-strike-global-offensive.our-recommendations')                
  @include('pages.games.counter-strike-global-offensive.server-information')

  <div class="row">
    <div class="col-md-6">
      @include('pages.games.counter-strike-global-offensive.contact-by-whatsapp')
    </div>
  </div>
</div>
@endsection