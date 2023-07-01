    <div class="accordion mt-3" id="topServers">
        @php $rank = 1; $podiums = array('success', 'warning', 'danger') @endphp

        @foreach ($top_servers as $server)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-bold @if ($rank != 1) collapsed @endif fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $rank }}" aria-controls="collapse{{ $rank }}">
                    <span class="badge text-bg-{{ $podiums[$rank - 1]}} me-2"> {{ $rank }} </span> {{ $server->hostname }}
                </button>
            </h2>
            
            <div id="collapse{{ $rank }}" class="accordion-collapse collapse @if ($rank == 1) show @endif" data-bs-parent="#topServers">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md mt-md-1">
                            <h3> ➡️ Resumen del Servidor </h3>
                            <div class="fs-5"> <strong> Nombre: </strong> <span class="fw-bold text-{{ $podiums[$rank - 1] }}"> {{ $server->hostname }} </span> </div>
                            <div class="fs-5"> <strong> Juego: </strong> <a href="{{ route('servers/search', ['game' => $server->game->protocol]) }}"> {{ $server->game->name }} </a> </div>
                            <div class="fs-5"> <strong> IP: </strong> {{ $server->server_address }}  </div>
                            <div class="fs-5"> <strong> Estado: </strong> @if ($server->status) <span class="badge text-bg-success"> ONLINE </span> @else <span class="badge text-bg-danger"> OFFLINE </span> @endif </div>
                            <div class="fs-5"> <strong> Administrado por: </strong> <a href="{{ $server->community->user->profile_url }}" target="_blank"> {{ $server->community->user->name }} </a> </div>
                        
                            <a class="btn btn-danger mt-3" href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}"> Más estadísticas </a>
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

                </div>
            </div>
        </div>

        @php $rank++ @endphp
        @endforeach
    </div>