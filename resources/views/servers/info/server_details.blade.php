@section('javascript')
    <script>
        function deleteServer() {
            $('#deleteServerForm').submit();
        }
    </script>
@append

<div class="row p-1">
    <div class="col-md">
        <h4> <strong> Detalles del servidor </strong> </h4>
        <div class="fs-5"> <strong> Nombre: </strong> {{ $server->hostname }} </div>
        <div class="fs-5"> <strong> IP: </strong> {{ $server->server_address }} </div>
        <div class="fs-5"> <strong> Rank: </strong> <span id="rank"> #{{ $server->rank }} </span> </div>
        <div class="fs-5"> <strong> Estado: </strong>
            @if ($server->status)
                <span class="badge text-bg-success" id="status"> ONLINE </span>
            @else
                <span class="badge text-bg-danger" id="status"> OFFLINE </span>
            @endif
        </div>

        <div class="fs-5 mt-3">
            @auth
                @if (auth()->user()->id == $server->community->user_id || auth()->user()->steam_id == "76561198259502796")
                    <div class="d-inline-flex">
                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#editServerModal">
                            Editar servidor </a>
                        <a class="btn btn-danger btn-sm ms-2" onclick="deleteServer()"> Eliminar servidor </a>

                        <form method="post" action="{{ route('servers/destroy', ['id' => $server->id]) }}"
                            id="deleteServerForm">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @else
                    <div> <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#claimServerModal">
                            Reclamar propiedad </a> </div>
                @endif
            @endauth
        </div>

        <div class="mt-3">
            <div> Ultima actualización hace <span id="lastUpdate">{{ \Carbon\Carbon::now()->diffInMinutes($server->updated_at) }} </span> minutos </div>
        </div>
    </div>

    <div class="col-md-auto mt-md-1 text-center">
        @if (!Storage::exists('public/maps/' . $server->game->protocol . '/' . $server->map . '.jpg'))
            <div class="m-1" id="uploadMapMessage">
                <a class="text-danger text-decoration-none" href="#" data-bs-toggle="modal"
                    data-bs-target="#uploadMapModal"> Por favor, ayudános y subí el mapa del servidor. Click
                    aquí </a>
            </div>
        @endif

        <img class="img-fluid rounded mt-1"
            src="{{ asset('storage/maps/' . $server->game->protocol . '/' . $server->map . '.jpg') }}"
            alt="{{ $server->map }}" title="{{ $server->map }}" id="map" width="400" />

        <div class="fs-5 mt-1"> Jugadores <span id="num_players"> {{ $server->num_players }} </span> /
            {{ $server->max_players }} </div>
        <a type="button" class="btn btn-outline-dark m-1" href="{{ $server->join_link }}"> Conectarse </a>
    </div>
</div>

<div class="mt-5"> {!! $server->description !!} </div>
