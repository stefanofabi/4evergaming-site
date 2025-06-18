@extends('gametracker.base')

@section('description', 'Encontrá servidores de juegos en línea, conocé nuevos jugadores y divertite al máximo')

@section('robots', 'index, follow')

@section('title')
4evergaming: Búsqueda de servidores de juegos, búsqueda de jugadores, estádisticas, rankings y mucho más! 
@endsection

@section('content')
<div class="container py-5">
    <!-- Título principal -->
    <div class="text-center mb-5">
        <h1 class="display-5 text-danger fw-bold">Explorá Servidores y Comunidades de Juegos</h1>
        <p class="text-light">Buscá servidores activos, descubrí comunidades y unite a partidas épicas.</p>
    </div>

    <!-- Buscador -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="/buscar-servidores" method="GET" class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Buscar servidor, IP o comunidad...">
                <button class="btn btn-danger" type="submit">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Botones destacados debajo del buscador -->
    <div class="text-center mb-5">
        <div class="d-flex flex-wrap justify-content-center gap-3">

            {{-- Ver todas las comunidades --}}
            <a href="{{ route('communities/index') }}" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm transition">
                🌐 Ver todas las comunidades
            </a>

            {{-- Agregar servidor --}}
            <button class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm transition"
                data-bs-toggle="modal" data-bs-target="#addServerModal">
                🎮 Agregar Servidor
            </button>

        </div>
    </div>


    <!-- Servidores destacados -->
    @include('gametracker.home.active_servers')


    <!-- Active communities -->
    @include('gametracker.home.communities')

    @include('communities.create')

</div>
@endsection
