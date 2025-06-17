<div class="mb-5">
    <h2 class="text-light mb-3">🔥 Servidores Destacados</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($servers as $server)
            <div class="col">
                <div class="card bg-dark text-light border border-danger h-100 shadow-sm d-flex flex-column">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-danger">{{ $server->hostname }}</h5>

                        @php
                            $mapPath = 'maps/' . $server->game->protocol . '/' . $server->map . '.jpg';
                            $mapUrl = asset('storage/' . $mapPath);
                            $defaultMapUrl = asset('images/default-map.jpg');
                            $connectLink = "steam://connect/{$server->ip}:{$server->port}";
                        @endphp

                        <img class="img-fluid mt-3"
                            src="{{ file_exists(public_path('storage/' . $mapPath)) ? $mapUrl : $defaultMapUrl }}"
                            alt="{{ $server->map }}"
                            title="{{ $server->map }}"
                            id="map"
                            width="400" />

                        <p class="small text-muted mt-2 mb-3">IP: {{ $server->ip }}:{{ $server->port }}</p>

                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" 
                            class="btn btn-outline-danger btn-sm flex-grow-1">
                            Ver Estadísticas
                            </a>

                            <a href="{{ $connectLink }}" 
                            class="btn btn-danger btn-sm flex-grow-1" 
                            rel="noopener noreferrer">
                            Conectarse
                            </a>
                        </div>
                    </div>
  
                </div>
            </div>
        @endforeach
    </div>
</div>
