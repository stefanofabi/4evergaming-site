@extends('base')

@section('description', 'Encontrá servidores de juegos en línea, conocé nuevos jugadores y divertite al máximo')

@section('robots', 'index, follow')

@section('title')
4evergaming: Formulario de registro de Servidor de Juegos
@endsection

@section('javascript')
<script type="module">
	$(document).ready(function() {
        // Select a option from list
        $('#jueguito').val("{{ old('game_id') ?? $game->id ?? '' }}");
        $('#country').val("{{ old('country_id') }}");
    });
</script>
@append

@section('content')

<div class="container">
    <h2 class="mt-3"> Agregar servidor </h2>
    <p> 
        ¡Añadí tu servidor de juegos y llegá al Top! Unite a nuestra plataforma de estadísticas y rankings para mejorar tu audiencia y convertirte en el líder indiscutible. 
        Obtené análisis detallados, competí con jugadores de élite y atraé a nuevos seguidores a tu comunidad. 
        ¡No te conformes con menos, sé el protagonista de la competición y demostrá quién manda en el mundo gamer! 🔥🔥
    </p>

    <p> Agregar tu servidor es muy simple! No te vamos a solicitar más datos y es completamente seguro </p>

    <form method="post" action="{{ route('servers/store') }}">
        @csrf

        <div class="row mt-3">
            <div class="col-md-6">
                <select class="form-select" name="game_id" id="jueguito">
                    <option value=""> Seleccioná el juego </option>
                    @foreach ($games as $game)
                    <option value="{{ $game->id }}"> {{ $game->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" name="ip" value="{{ old('ip') }}" placeholder="IP" aria-label="IP">
                    <span class="input-group-text">:</span>
                    <input type="number" class="form-control" name="port" value="{{ old('port') }}" placeholder="Puerto" aria-label="Puerto" min="0" max="65535">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <select class="form-select" name="country_id" id="country">
                    <option value="" selected> Seleccioná el país al que pertenece el servidor </option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}"> {{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger float-end"> ➕ Agregar Servidor </button>
            </div>
        </div>
    </form>
</div>
@endsection