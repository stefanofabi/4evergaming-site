@extends('base')

@section('description', 'Encontrá servidores de juegos en línea, conocé nuevos jugadores y divertite al máximo')

@section('robots', 'index, follow')

@section('title')
4evergaming: Búsqueda de servidores de {{ $game->name }}, búsqueda de jugadores, estádisticas, rankings y mucho más! 
@endsection

@section('content')
@include('servers.search.show_all_games')

@if (empty($filter))
<div class="mt-4 ms-4 me-4">
    @include('servers.search.winners_podium')
</div>  
@endif

@include('servers.search.filter_servers')

<div class="mt-4 ms-4 me-4">
    @include('servers.search.ranking_table')
</div>

@include('communities.create')
@include('servers.search.create')
@endsection