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
    <div class="collapse" id="gamesCollapse">
        @foreach ($games as $game_aux)
        <a type="button" class="btn btn-outline-danger ms-3" href="{{ route('servers/search', ['game' => $game_aux->protocol]) }}">
            <img loading="lazy" src="{{ asset('images/games-icons/'.$game_aux->logo) }}" alt="Logo de {{ $game_aux->name }}" width="30" height="30" title="{{ $game_aux->name }}">
            {{ $game_aux->name }} 
        </a>
        @endforeach
    </div>
</div>

<div class="d-flex">
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow rounded-3 w-100 mt-3 ms-4 me-4">
    
        <a class="navbar-brand" href=""> <img class="ms-3" src="{{ asset('images/games-icons/'.$game->large_logo) }}" heigth="120" width="200" title="Servidores de {{ $game->name }}" alt="Logo {{ $game->name }}"> </a>

        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-2" id="collapsibleNavbar">
            <form class="w-100" action="{{ route('servers/search', ['game' => $game->protocol]) }}">
                <div class="d-inline-flex p-2 w-100">
                    
                    <input class="form-control" type="text" name="filter" value="{{ old('filter') ?? $filter ?? '' }}" placeholder="Ingresá nombre o IP para filtrar" aria-label="default input example">
                        
                    <button type="submit" class="btn btn-danger ms-3"> Buscar </button>
                </div>     
            </form>
            <div class="d-flex justify-content-md-end w-100 me-3">
                @if (auth()->user())
                    @if (is_null(auth()->user()->community))
                    <button type="button" class="btn btn-outline-dark ms-5" data-bs-toggle="modal" data-bs-target="#addCommunityModal"> ➕ Agregar Comunidad </button>
                    @else 
                    <a class="btn btn-outline-dark ms-5" href="{{ route('servers/create', ['game' => $game->protocol]) }}"> ➕ Agregar Servidor </a>
                    @endif
                @else
                <a class="btn btn-outline-dark ms-5" href="{{ route('login') }}"> Iniciar sesión con Steam </a>
                @endif
            </div>
        </div>
    </nav>
</div>

<div class="mt-4 ms-4 me-4">
    @include('servers.accordion')

    @include('servers.ranking_table')
</div>

@include('communities.store')
@endsection