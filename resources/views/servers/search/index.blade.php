@extends('base')

@section('description', 'Encontrá servidores de juegos en línea, conocé nuevos jugadores y divertite al máximo')

@section('robots', 'index, follow')

@section('title')
4evergaming: Búsqueda de servidores de {{ $game->name }}, búsqueda de jugadores, estádisticas, rankings y mucho más! 
@endsection

@section('content')
<div class="d-flex justify-content-center mt-4">
    <a class="text-decoration-none text-dark fs-5" data-bs-toggle="collapse" href="#gamesCollapse" role="button" aria-expanded="false" aria-controls="gamesCollapse">
        Ver todos los juegos ⬇️
    </a>
</div>

<div class="d-flex justify-content-center mt-3">
    <div class="collapse text-center" id="gamesCollapse">
        @foreach ($games as $game_aux)
        <a type="button" class="btn btn-outline-danger m-1" href="{{ route('servers/search', ['game' => $game_aux->protocol]) }}">
            <img loading="lazy" src="{{ asset('images/games-icons/'.$game_aux->logo) }}" alt="Logo de {{ $game_aux->name }}" width="30" height="30" title="{{ $game_aux->name }}">
            {{ $game_aux->name }} 
        </a>
        @endforeach
    </div>
</div>

@include('servers.search.filter_servers')

<div class="mt-4 ms-4 me-4">
    @include('servers.search.winners_podium')

    @include('servers.search.ranking_table')
</div>

@include('communities.create')
@include('servers.search.create')
@endsection