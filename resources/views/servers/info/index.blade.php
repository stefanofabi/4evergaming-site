@extends('gametracker.base')

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

@section('css')
<style>
    .table-hover tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table-hover tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.1);
    }
    
  .btn-gradient {
    background: linear-gradient(45deg, #ff0057, #ff8a00);
    border: none;
    color: white;
    transition: background 0.3s ease;
  }

  .btn-gradient:hover {
    background: linear-gradient(45deg, #ff8a00, #ff0057);
  }
</style>
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
        <a class="text-decoration-none text-light fs-5" data-bs-toggle="collapse" href="#gamesCollapse" role="button" aria-expanded="false" aria-controls="gamesCollapse">
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

    <div class="container mt-5">
        <div class="card h-100 text-light shadow border-0 rounded-4" 
            style="background: linear-gradient(135deg, #1b1b1b 30%, #0f0f0f 100%);">
            <div class="d-flex flex-column flex-md-row align-items-center p-4 gap-4">

            {{-- Contenido principal sin logo --}}
            <div class="flex-grow-1">
                <h1 class="fw-bold mb-2 text-gradient" style="background: linear-gradient(45deg, #ff0057, #ff8a00); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                {{ $server->hostname }}
                </h1>
                
                <div class="d-flex align-items-center mb-3 gap-3 text-secondary fs-5">
                {{-- Bandera redonda y más chica --}}
                <img src="{{ asset('images/country-flags/' . $server->country->flag) }}" 
                    alt="{{ $server->country->name }}" 
                    title="{{ $server->country->name }}" 
                    style="width: 28px; height: 28px; object-fit: cover; border-radius: 50%;">
                <span>{{ $server->game->name }} en <strong>{{ $server->country->name }}</strong></span>
                </div>
                
                {{-- Botón de acción --}}
                <a href="{{ $server->join_link }}" target="_blank" class="btn btn-gradient btn-lg px-4 shadow-sm">
                <i class="bi bi-controller me-2"></i> ¡Conectarse!
                </a>
            </div>

            {{-- Estado servidor --}}
            <div class="d-none d-md-flex flex-column align-items-center ms-4">
                @if($server->status)
                <span class="badge bg-success fs-6 px-3 py-2 mb-2 shadow-sm">ONLINE</span>
                @else
                <span class="badge bg-danger fs-6 px-3 py-2 mb-2 shadow-sm">OFFLINE</span>
                @endif

                <small class="text-white text-center">Última actualización:<br> 
                {{ \Carbon\Carbon::parse($server->updated_at)->diffForHumans() }}
                </small>
            </div>
            </div>
        </div>
    </div>




    <div class="container mt-3">
        @include('servers.info.server_details')
    </div>


    <div class="container mt-4">
        <!-- <h3 class="text-light mb-3">➡️ Comunidad</h3> -->
        <div class="row row-cols-1 row-cols-md-1 g-4">
            <div class="col">
                <div class="card h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
                    <div class="row g-0 h-100">
                        {{-- Columna izquierda: Logo --}}
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            <a href="{{ route('communities/show', ['id' => $server->community_id]) }}">
                                <img src="{{ asset('storage/communities/' . $server->community->logo) }}?t={{ $server->community->updated_at }}"
                                    class="img-fluid rounded" alt="{{ $server->community->name }} Logo">
                            </a>
                        </div>

                        {{-- Columna derecha: Contenido + redes abajo --}}
                        <div class="col-md-8 d-flex flex-column justify-content-between p-3">
                            <div>
                                <h2 class="card-title">{{ $server->community->name }}</h2>
                                <p class="card-text">{!! Str::limit(strip_tags($server->community->description), 120) !!}</p>
                            </div>
                            <div class="text-end mt-2">
                                @if($server->community->instagram)
                                    <a href="http://instagram.com/{{ $server->community->instagram }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Instagram">
                                        <i class="bi bi-instagram fs-5"></i>
                                    </a>
                                @endif
                                @if($server->community->youtube)
                                    <a href="http://youtube.com/channel/{{ $server->community->youtube }}" target="_blank" class="text-light ms-2 text-decoration-none" title="YouTube">
                                        <i class="bi bi-youtube fs-5"></i>
                                    </a>
                                @endif
                                @if($server->community->discord)
                                    <a href="http://discord.gg/{{ $server->community->discord }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Discord">
                                        <i class="bi bi-discord fs-5"></i>
                                    </a>
                                @endif
                                @if($server->community->tiktok)
                                    <a href="http://tiktok.com/{{ '@' . $server->community->tiktok }}" target="_blank" class="text-light ms-2 text-decoration-none" title="TikTok">
                                        <i class="bi bi-tiktok fs-5"></i>
                                    </a>
                                @endif
                                @if($server->community->website)
                                    <a href="{{ $server->community->website }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Sitio Web">
                                        <i class="bi bi-globe2 fs-5"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="container">
        <div class="row">
            <div class="col-md-6 mt-3">
                @include('servers.info.players_online')
            </div>
            <div class="col-md-6 mt-3">
                @include('servers.info.player_ranking')
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="card p-3 h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%) !important;">
            <h3 class="mb-3"> ➡️ Estadísticas </h3>

            @include('servers.info.favorite_maps')
            @include('servers.info.online_player_history')
        </div>
    </div>


    @include('servers.info.claim_server')
    @include('servers.info.edit')
    @include('servers.info.upload_map')
@endsection
