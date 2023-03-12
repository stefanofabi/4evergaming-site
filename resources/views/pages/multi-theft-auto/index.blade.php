@extends('base')

@section('title')
4evergaming: Host MTA:SA Barato con Panel Web, Anti-DDoS, MySQL y baja latencia. Alojado en Argentina
@endsection

@section('description', 'Servidores de Juegos en Argentina: Rápido, Seguro y Soporte 365. Activación automática. ¡Encontrá el Servidor más barato con mejor servicio en 4evergaming!')

@section('robots', 'index, follow')

@section('css')
<style>
  .overlay {
    position: relative;
    background-color: transparent;
    background-image: url("{{ asset('images/games/multi-theft-auto/mta-banner.jpg') }}");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: top;
    opacity: 0.95;
    height: 95vh;
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
</style>
@endsection

@section('content')
@include('pages.multi-theft-auto.header')

@include('pages.multi-theft-auto.characteristics-servers')

@include('pages.multi-theft-auto.server-location')

@include('pages.multi-theft-auto.available-plans')

@include('pages.multi-theft-auto.trust-pilot')

@include('pages.multi-theft-auto.frequently-questions')
@endsection