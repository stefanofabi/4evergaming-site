@extends('gametracker.base')

@section('description', 'Encontrá servidores de juegos en línea, conocé nuevos jugadores y divertite al máximo')

@section('robots', 'index, follow')

@section('title')
4evergaming: Búsqueda de servidores de {{ $game->name ?? 'juegos' }}, búsqueda de jugadores, estádisticas, rankings y mucho más! 
@endsection

@section('css')

<style>
  .badge-game {
    display: inline-block;
    padding: 0.35em 0.75em;
    font-size: 0.875rem;
    font-weight: 600;
    color: #dc3545; /* Bootstrap danger red */
    background-color: rgba(33, 37, 41, 0.8); /* bg-dark with opacity */
    border: 1.5px solid #dc3545;
    border-radius: 0.375rem; /* rounded */
    text-shadow: 0 0 4px rgba(220, 53, 69, 0.8);
    box-shadow: 0 0 6px rgba(220, 53, 69, 0.6);
    user-select: none;
    transition: background-color 0.3s ease, color 0.3s ease;
    cursor: default;
  }

  .badge-game:hover {
    background-color: #dc3545;
    color: #fff;
    text-shadow: none;
    box-shadow: 0 0 8px #dc3545;
  }

  .table-dark {
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(255, 255, 255, 0.05);
    --bs-table-striped-color: #eee;
    --bs-table-hover-bg: rgba(255, 255, 255, 0.1);
    --bs-table-hover-color: #fff;
}

.table-hover tbody tr:hover {
    background-color: rgba(255, 0, 0, 0.15) !important; /* efecto rojo tenue al pasar mouse */
}

.action-icon:hover {
    filter: brightness(1.3);
    cursor: pointer;
}

a.text-warning:hover {
    color: #ff4c4c !important; /* rojo gamer en hover */
}

.badge.bg-danger {
    font-weight: 700;
}

.badge.bg-secondary {
    background-color: #3a3a3a !important;
    color: #ccc;
}

</style>
@endsection

@section('content')
@include('servers.search.show_all_games')

@include('servers.search.filter_servers')

<div class="mt-4 ms-4 me-4">
    @include('servers.search.ranking_table')
</div>

@include('communities.create')
@include('servers.search.create')
@endsection