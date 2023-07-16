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

    var favoriteMapsChart = document.getElementById('favoriteMapsChart');
    var myChart = new Chart(favoriteMapsChart, {
        type: 'pie',
        data: {
            labels: @json($server->favoriteMaps()->pluck('map')->toArray()),
            datasets: [{
                label: 'Cantidad de veces jugadas',
                data: @json($server->favoriteMaps()->pluck('count')->toArray()),
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    var onlinePlayerHistoryChart = document.getElementById('onlinePlayerHistoryChart');
    var myChart = new Chart(onlinePlayerHistoryChart, {
        type: 'line',
        radius: 500,
        data: {
            labels: @json($server->onlinePlayerHistories()->select(DB::raw("DATE_FORMAT(updated_at, '%D %M %H:%iHs.') as day"))->get()->pluck('day')->toArray()),
            datasets: [{
                label: 'Cantidad de jugadores en línea',
                data: @json($server->onlinePlayerHistories()->pluck('count')->toArray()),
                backgroundColor: '#f47363',
                borderColor: '#f47363',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

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
                    <img class="img-fluid pt-1 ps-3" src="{{ asset('images/games-icons/'.$server->game->logo) }}" alt="{{ $server->game->name }}">
                </a>
            </div>
            
            <div class="col-md">
                <h3 class="fw-bold"> {{ $server->hostname }} </h3>
                
                <div>
                    <img class="me-1" src="{{ asset('images/country-flags/'.$server->country->flag) }}" title="{{ $server->country->name }}" alt="{{ $server->country->name }}"> 
                    {{ $server->game->name }} en {{ $server->country->name }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            @include('servers.info.server_details')

            @include('servers.info.players_online')
        </div>

        <div class="col-md-4 mt-3 mt-md-0">
            @include('servers.info.server_description')

            @include('servers.info.favorite_maps')

            @include('servers.info.online_player_history')
        </div>
    </div>
</div>

@include('servers.info.claim_server')
@include('servers.info.edit')
@include('servers.info.upload_map')
@endsection