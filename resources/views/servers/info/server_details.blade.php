@section('javascript')    
<script>
    function deleteServer() {
        $('#deleteServerForm').submit();
    }
</script>
@append

    <div class="card">    
        <div class="card-header">
            <div class="row p-1">
                <div class="col-md-6"> <h4> <strong> Detalles del servidor </strong> </h4> </div>

                <div class="col-md-6 fst-italic text-md-end">
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
                <div class="col-md-8 mt-md-1">
                    <h3> ➡️ Resumen del Servidor </h3>
                    <div class="fs-5"> <strong> Nombre: </strong> {{ $server->hostname }} </div>
                    <div class="fs-5"> <strong> Juego: </strong> <a href="{{ route('servers/search', ['game' => $server->game->protocol]) }}"> {{ $server->game->name }} </a> </div>
                    <div class="fs-5"> <strong> IP: </strong> {{ $server->server_address }}  </div>
                    <div class="fs-5"> <strong> Rank: </strong> #{{ $server->rank }}  </div>
                    <div class="fs-5"> <strong> Estado: </strong> @if ($server->status) <span class="badge text-bg-success"> ONLINE </span> @else <span class="badge text-bg-danger"> OFFLINE </span> @endif </div>
                    <div class="fs-5 mt-3"> 
                        @auth
                            @if (auth()->user()->id == $server->community->user_id) 
                                <div class="d-inline-flex"> 
                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#editServerModal"> Editar servidor </a> 
                                    <a class="btn btn-danger btn-sm ms-2" onclick="deleteServer()"> Eliminar servidor </a> 

                                    <form method="post" action="{{ route('servers/destroy', ['id' => $server->id]) }}" id="deleteServerForm">
                                        @csrf
                                        @method('DELETE') 
                                    </form>
                                </div>
                            @else 
                                <div> <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#claimServerModal"> Reclamar propiedad </a> </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="col-md mt-md-1 mt-3 text-md-center">
                    <h3> ➡️ Mapa actual </h3>

                    @if(! Storage::exists('public/maps/'. $server->game->protocol .'/'.$server->map .'.jpg'))
                    <div class="m-1">
                        <a class="text-danger text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#uploadMapModal"> Por favor, ayudános y subí el mapa del servidor. Click aquí </a>
                    </div>
                    @endif
                    
                    <img class="img-fluid rounded mt-1" src="{{ asset('storage/maps/'. $server->game->protocol .'/'. $server->map .'.jpg') }}" alt="{{ $server->map }}" title="{{ $server->map }}" />

                    <div class="fs-5 mt-1"> Jugadores {{ $server->num_players }} / {{ $server->max_players }} </div>
                    <a type="button" class="btn btn-outline-dark m-1" href="{{ $server->join_link }}"> Conectarse </a>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-auto">
                    <h3> ➡️ Comunidad </h3>
                    
                    <a href="@if (empty($server->community->contact_url)) # @else {{ $server->community->contact_url }} @endif" @if (! empty($server->community->contact_url)) target="_blank" @endif> 
                        <img class="img-fluid rounded" src="{{ asset('storage/communities/'.$server->community->logo) }}" alt="{{ $server->community->name }}">
                    </a>
                </div>

                <div class="col-md">
                    <div class="fs-5 mt-md-5 mt-3"> <strong> Nombre: </strong> {{ $server->community->name }} </div>

                    <p class="mt-1"> @if (strlen($server->community->description) > 0) {{ substr($server->community->description, 0, 200) }}... @endif </p>
                </div>
            </div>
        </div>
    </div>
