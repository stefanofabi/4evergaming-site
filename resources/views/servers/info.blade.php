@extends('base')

@section('javascript')
<script type="module">
    $(document).ready(function() {
        getGameState('{{ $server->game->protocol }}', '{{ $server->ip }}', '{{ $server->port }}');
    });

    function getGameState(game, ip, port)
    {
        var parameters = {
            "game": game,
            "ip": ip,
            "port": port,
        };

        $.ajax({
            data: parameters,
            url: "{{ route('api/games') }}",
            type: 'get',
            error: function (xhr, status) {
                console.log(xhr.statusText);
            },
            success: function (response) {
                console.log(response);
            }
        });
    }
</script>
@append

@section('robots', 'index, follow')

@section('title')
{{ $server->hostname }} | [{{ $server->game->short_name}}] {{ $server->game->name }}
@endsection

@section('description')
@if (empty($server->description)) Visitá 4evergaming.com.ar para obtener la información más reciente sobre servidores de juegos! @else {{ $server->description }} @endif
@endsection

@section('content')
<div class="d-flex justify-content-center mt-4">
    <a class="text-decoration-none text-dark fs-5" data-bs-toggle="collapse" href="#gamesCollapse" role="button" aria-expanded="false" aria-controls="gamesCollapse">
        Ver todos los juegos ⬇️
    </a>
</div>

<div class="d-flex justify-content-center mt-3">
    <div class="collapse text-center" id="gamesCollapse">
        @foreach ($games as $game)
        <a type="button" class="btn btn-outline-danger m-1" href="{{ route('servers/search', ['game' => $game->protocol]) }}">
            <img loading="lazy" src="{{ asset('images/games-icons/'.$game->logo) }}" alt="Logo de {{ $game->name }}" width="30" height="30" title="{{ $game->name }}">
            {{ $game->name }} 
        </a>
        @endforeach
    </div>
</div>

<div class="container mt-3">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-1 d-none d-md-block">
                <a href="{{ route('servers/search', ['game' => $server->game->protocol]) }}"> 
                    <img class="pt-1 ps-3" src="{{ asset('images/games-icons/'.$server->game->logo) }}" alt="{{ $server->game->name }}">
                </a>
            </div>
            
            <div class="col-md">
                <h3 class="fw-bold text-nowrap"> {{ $server->hostname }} </h3>
                
                <div>
                    <img class="me-1" src="{{ asset('images/country-flags/'.$server->country->flag) }}" title="{{ $server->country->name }}" alt="{{ $server->country->name }}"> 
                    {{ $server->game->name }} en {{ $server->country->name }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card p-3">        
        <div class="row">
            <div class="col-md mt-md-1">
                <h3> ➡️ Resumen del Servidor </h3>
                <div class="fs-5 text-nowrap"> <strong> Nombre: </strong> {{ $server->hostname }} </div>
                <div class="fs-5"> <strong> Juego: </strong> <a href="{{ route('servers/search', ['game' => $server->game->protocol]) }}"> {{ $server->game->name }} </a> </div>
                <div class="fs-5"> <strong> IP: </strong> {{ $server->server_address }}  </div>
                <div class="fs-5"> <strong> Estado: </strong> @if ($server->status) <span class="badge text-bg-success"> ONLINE </span> @else <span class="badge text-bg-danger"> OFFLINE </span> @endif </div>
                <div class="fs-5"> <strong> Administrado por: </strong> <a href="{{ $server->community->user->profile_url }}" target="_blank"> {{ $server->community->user->name }} </a> </div>
            </div>

            <div class="col-md mt-md-1 mt-3 text-md-center">
                <h3> ➡️ Mapa actual </h3>
                <div> 
                    @if ($server->game->protocol == "cs16")
                    <img src="https://image.gametracker.com/images/maps/160x120/cs/{{ $server->map }}.jpg" title="{{ $server->map }}" />
                    @else 
                    <img src="https://image.gametracker.com/images/maps/160x120/{{ $server->game->protocol }}/{{ $server->map }}.jpg" title="{{ $server->map }}" />
                    @endif
                </div>

                <div class="fs-5 mt-1"> Jugando {{ $server->num_players }} / {{ $server->max_players }} </div>
                <a type="button" class="btn btn-outline-dark ms-1" href="{{ $server->join_link }}"> Conectarse </a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-2" style="width: 200px">
                <h3> ➡️ Comunidad </h3>
                
                <a href="{{ $server->community->contact_url }}" target="_blank"> 
                    <img src="{{ asset('storage/communities/'.$server->community->logo) }}" alt="{{ $server->community->name }}" width="150" height="150">
                </a>
            </div>

            <div class="col-md-6">
                <div class="fs-5 mt-md-5 mt-3"> <strong> Nombre: </strong> {{ $server->community->name }} </div>
                <div class="fs-5"> <strong> URL de contacto: </strong> <a href="{{ $server->community->contact_url }}" target="_blank"> {{ $server->community->contact_url }} </a> </div> 

                <p class="mt-3"> {{ $server->community->description }} </p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card p-3">
        <h3> ➡️ Jugadores en línea </h3>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Nombre</th>
                    <th class="text-center" scope="col">Score</th>
                    <th class="text-center" scope="col">Tiempo jugado</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse (collect($server->players)->sortByDesc('gq_score') as $player)
                    <tr>
                        <td> {{ $player['name'] }} </td>
                        <td class="text-center"> {{ $player['gq_score'] }} </td>
                        <td class="text-center"> {{ $player['gq_time_human'] }} </td>
                    </tr>
                    @empty
                        @if ($server->num_players > 0)
                        <tr> <td class="text-danger" colspan="4"> No pudimos obtener los jugadores conectados </td> </tr>
                        @else 
                        <tr> <td class="text-danger" colspan="4"> No hay jugadores conectados 😔 </td> </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection