    <div class="card">    
        <div class="card-header">
            <div class="row p-1">
                <div class="col-md-8"> <h4> <strong> Detalles del servidor </strong> </h4> </div>

                <div class="col-md-auto fst-italic">
                    @php 
                    $lastUpdate = strtotime($server->updated_at);
                    $now = time();	

                    $diffMinutes = floor(($now - $lastUpdate) / 60 );
                    @endphp

                    Ultima actualización hace {{ $diffMinutes }} minutos
                </div>
            </div>
        </div>    

        <div class="card-body">
            <div class="row">
                <div class="col-md mt-md-1">
                    <h3> ➡️ Resumen del Servidor </h3>
                    <div class="fs-5"> <strong> Nombre: </strong> {{ $server->hostname }} </div>
                    <div class="fs-5"> <strong> Juego: </strong> <a href="{{ route('servers/search', ['game' => $server->game->protocol]) }}"> {{ $server->game->name }} </a> </div>
                    <div class="fs-5"> <strong> IP: </strong> {{ $server->server_address }}  </div>
                    <div class="fs-5"> <strong> Rank: </strong> #{{ $server->rank }}  </div>
                    <div class="fs-5"> <strong> Estado: </strong> @if ($server->status) <span class="badge text-bg-success"> ONLINE </span> @else <span class="badge text-bg-danger"> OFFLINE </span> @endif </div>
                    <div class="fs-5 mt-3"> 
                        <strong> Administrado por: </strong> <a href="{{ $server->community->user->profile_url }}" target="_blank">{{ $server->community->user->name }}</a> 
                        
                        @auth
                        <span class="fs-6"> <a class="btn btn-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#claimServerModal"> Reclamar servidor </a> </span>
                        @endauth
                    </div>
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
