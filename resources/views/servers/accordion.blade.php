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
                        <div class="col-9">
                            <h2 class="fw-bold text-warning"> {{ $server->community->name }} </h2> 
                            
                            <p class="fs-5"> {{ $server->community->description }} </p>
                                
                            <p class="fw-bold fs-5"> IP: {{ $server->server_address }} <a class="btn btn-danger btn-md ms-3" href="{{ $server->join_link }}"> Entrar </a></p>

                            <p>
                            <span class="fw-bold fs-5"> Mapa actual: </span> <br />
                            @if ($server->game->protocol == "cs16")
                            <img src="https://image.gametracker.com/images/maps/160x120/cs/{{ $server->map }}.jpg" title="{{ $server->map }}" />
                            @else 
                            <img src="https://image.gametracker.com/images/maps/160x120/{{ $server->game->protocol }}/{{ $server->map }}.jpg" title="{{ $server->map }}" />
                            @endif
                            <br />
                            <span class="fw-bold fs-4"> Jugadores: {{ $server->users_online }}/{{ $server->max_players }} </span>
                            </p>
                            
                            <p class="fw-bold fs-5"> URL de contacto: {{ $server->community->contact_url }} </p>

                            <p class="fw-bold fs-5"> Calificación: @for ($i = 1; $i <= $server->community->calification; $i++) ⭐ @endfor </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php $rank++ @endphp
        @endforeach
    </div>