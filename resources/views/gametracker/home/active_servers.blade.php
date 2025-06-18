<div class="mb-5">
    <h2 class="text-light mb-4">🔥 <span class="text-warning">Servidores Destacados</span></h2>
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($servers as $server)
            <div class="col">
                <div class="card h-100 text-light shadow border-0"
                     style="background: linear-gradient(135deg, #222 30%, #111 100%);
                            box-shadow: 0 0 15px 3px rgba(255, 215, 0, 0.6); 
                            position: relative; display: flex; flex-direction: column;">

                    {{-- Insignia TOP --}}
                    <div class="position-absolute" style="top:10px; left:10px; z-index: 10; background: #ffd700; color: #2b0000; padding: 0.25rem 0.75rem; border-radius: 0 0.5rem 0.5rem 0; font-weight: 700; box-shadow: 0 0 6px rgba(255, 215, 0, 0.9);">
                        ⭐ TOP
                    </div>

                    <div class="card-body d-flex flex-column" style="padding-top: 3.5rem;">
                        {{-- Nombre del servidor --}}
                        <h5 class="card-title text-warning fw-bold fs-3 text-uppercase mb-3" style="text-shadow: 0 0 8px rgba(255, 215, 0, 0.8);">
                            {{ \Illuminate\Support\Str::limit($server->community->name, 20, '...') }}
                        </h5>

                        @php
                            $mapPath = 'maps/' . $server->game->protocol . '/' . $server->map . '.jpg';
                            $mapUrl = asset('storage/' . $mapPath);
                            $defaultMapUrl = asset('images/default-map.jpg');
                            $connectLink = "steam://connect/{$server->ip}:{$server->port}";
                        @endphp

                        {{-- Imagen del mapa --}}
                        <img class="img-fluid rounded border border-secondary mb-3"
                             src="{{ file_exists(public_path('storage/' . $mapPath)) ? $mapUrl : $defaultMapUrl }}"
                             alt="{{ $server->map }}"
                             title="{{ $server->map }}"
                             id="map"
                             width="400" 
                             style="object-fit: cover; max-height: 180px;" />

                        <p class="mb-3 text-light fs-5" style="opacity: 0.9;">
                            IP: {{ $server->ip }}:{{ $server->port }}
                        </p>
                        {{-- Botones --}}
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" 
                               class="btn btn-outline-light btn-lg flex-grow-1 fw-semibold shadow-sm btn-glow-light">
                                📊 Estadísticas
                            </a>

                            <a href="{{ $connectLink }}" 
                               class="btn btn-warning btn-lg flex-grow-1 fw-semibold shadow-sm btn-glow-warning" 
                               rel="noopener noreferrer">
                                🚀 Conectarse
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@section('css')
<style>
    /* Glow suave para botones */
    .btn-glow-light {
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
        transition: box-shadow 0.3s ease;
    }
    .btn-glow-light:hover {
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.7);
    }

    .btn-glow-warning {
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.6);
        transition: box-shadow 0.3s ease;
    }
    .btn-glow-warning:hover {
        box-shadow: 0 0 20px rgba(255, 193, 7, 0.9);
    }
</style>
@append