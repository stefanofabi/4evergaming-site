@extends('base')

@section('javascript')
    <script type="module">
        var timer = 0;

        $(document).ready(function() {
            setTimeout(function() {
                getGameState('{{ $server->game->protocol }}', '{{ $server->ip }}', '{{ $server->port }}');
            }, 300000 - {{ \Carbon\Carbon::now()->diffInMilliseconds($server->updated_at) }});

            setTimeout(updateTimer, {{ \Carbon\Carbon::now()->diffInMilliseconds($server->updated_at) }} % 60000);

            timer = {{ \Carbon\Carbon::now()->diffInMinutes($server->updated_at) }};
        });

        function updateTimer() {
            timer++;
            updateValue("lastUpdate", timer);

            setTimeout(updateTimer, 60000);
        }

        function getGameState(game, ip, port) {
            var parameters = {
                "game": game,
                "ip": ip,
                "port": port,
            };

            $.ajax({
                data: parameters,
                url: "{{ route('api/servers/show') }}",
                type: 'get',
                dataType: 'json',
                error: function(xhr, status) {
                    console.log(xhr.statusText);
                },
                success: function(response) {
                    console.log(response);

                    timer = 0;
                    updateTimer();

                    updateValue("rank", "#" + response.rank);

                    if (response.status) {
                        $('#status').removeClass('bg-danger');
                        $('#status').addClass('bg-success');
                        updateValue("status", "ONLINE");
                    } else {
                        $('#status').removeClass('bg-success');
                        $('#status').addClass('bg-danger');
                        updateValue("status", "OFFLINE");
                    }

                    if ($('#map').attr('title') != response.map) {
                        $('#uploadMapMessage').addClass('d-none');

                        $('#map').attr('src',
                            '{{ env('APP_URL') }}/storage/maps/{{ $server->game->protocol }}/' + response
                            .map + '.jpg');
                        $('#map').attr('alt', response.map);
                        $('#map').attr('title', response.map);
                    }

                    updateValue("num_players", response.num_players);

                    setTimeout(function() {
                        getGameState('{{ $server->game->protocol }}', '{{ $server->ip }}',
                            '{{ $server->port }}');
                    }, 300000);
                }
            });
        }

        function updateValue(fieldId, value) {
            $('#' + fieldId).fadeOut(300, function() {
                $('#' + fieldId).text(value);
                $('#' + fieldId).fadeIn(300);
            });
        }
    </script>
@append

@section('robots', 'index, follow')

@section('title')
    {{ $server->hostname }} | [{{ $server->game->short_name }}] {{ $server->game->name }}
@endsection

@section('description')
    @if (empty($server->description))
        Visitá 4evergaming.com.ar para obtener la información más reciente sobre servidores de juegos!
    @else
        {{ $server->description }}
    @endif
@endsection

@section('content')
    <div class="d-flex justify-content-center mt-4">
        <a class="text-decoration-none text-dark fs-5" data-bs-toggle="collapse" href="#gamesCollapse" role="button"
            aria-expanded="false" aria-controls="gamesCollapse">
            Ver todos los juegos ⬇️
        </a>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <div class="collapse text-center" id="gamesCollapse">
            @foreach ($games as $game)
                <a type="button" class="btn btn-outline-danger m-1"
                    href="{{ route('servers/search', ['game' => $game->protocol]) }}">
                    <img loading="lazy" src="{{ asset('images/games-icons/' . $game->logo) }}"
                        alt="Logo de {{ $game->name }}" width="30" height="30" title="{{ $game->name }}">
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
                        <img class="img-fluid pt-1 ps-3" src="{{ asset('images/games-icons/' . $server->game->logo) }}"
                            alt="{{ $server->game->name }}">
                    </a>
                </div>

                <div class="col-md">
                    <h3 class="fw-bold"> {{ $server->hostname }} </h3>

                    <div>
                        <img class="me-1" src="{{ asset('images/country-flags/' . $server->country->flag) }}"
                            title="{{ $server->country->name }}" alt="{{ $server->country->name }}">
                        {{ $server->game->name }} en {{ $server->country->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="card p-3">
            @include('servers.info.server_details')
        </div>
    </div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                <div class="col-md-auto">
                    <h3 class="mb-3"> ➡️ Comunidad </h3>

                    <a href="{{ route('communities/show', ['id' => $server->community_id]) }}">
                        <img class="img-fluid rounded"
                            src="{{ asset('storage/communities/' . $server->community->logo) }}?t={{ $server->community->updated_at }}"
                            alt="{{ $server->community->name }}" width="200">
                    </a>
                </div>

                <div class="col-md">
                    <div class="fs-4 mt-md-5 mt-3"> {{ $server->community->name }} </div>

                    <p class="mt-1"> {!! $server->community->description !!} </p>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        @include('servers.info.players_online')
    </div>

    <div class="container mt-3">
        @include('servers.info.player_ranking')
    </div>

    <div class="container mt-3">
        <div class="card p-3">
            <h3 class="mb-3"> ➡️ Estadísticas </h3>

            @include('servers.info.favorite_maps')
            @include('servers.info.online_player_history')
        </div>
    </div>

    @include('servers.info.claim_server')
    @include('servers.info.edit')
    @include('servers.info.upload_map')

@endsection
