@extends('base')

@section('description', 'Servidores de Juegos en Argentina: Rápido, Seguro y Soporte 365. Activación automática. ¡Encontrá el Servidor más barato con mejor servicio en 4evergaming!')

@section('robots', 'index, follow')

@section('title')
4evergaming: Servidores de Juegos en Argentina desde ${{ $dollar_price * 4 * 0.35 }} al mes
@endsection

@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col">
      @include('pages/home/carousel')
    </div>
    
    <div class="col-lg-4 col-sm-12 mt-2">
      @include('pages/home/most-popular-games')
    </div>
  </div>

  @include('pages.home.clients-who-trust')

  @include('pages.home.without-taxation')

  @include('pages.home.why-4evergaming')

  @include('pages.home.cases-success')

  @include('pages.home.link-interests')

  @include('pages.home.about-4evergaming')
</div>
@endsection