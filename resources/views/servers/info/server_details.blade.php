@section('javascript')
<script>
    function deleteServer() {
        if(confirm("¿Estás seguro que quieres eliminar este servidor? Esta acción no se puede deshacer.")) {
            document.getElementById('deleteServerForm').submit();
        }
    }

    // Tooltip bootstrap init
    document.addEventListener('DOMContentLoaded', () => {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(t => new bootstrap.Tooltip(t))
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
            .forEach(tooltipEl => {
                new Tooltip(tooltipEl, {
                    trigger: 'manual' // <--- Este cambio es clave
                });
            });
    });

    function copyToClipboard(element) {
        const address = element.textContent.trim();
        const textToCopy = `connect ${address}`;

        navigator.clipboard.writeText(textToCopy).then(() => {
            const tooltip = Tooltip.getInstance(element);
            tooltip.show();

            setTimeout(() => {
                tooltip.hide();
            }, 2000);
        }).catch(err => {
            console.error('Error al copiar al portapapeles:', err);
        });
    }

</script>
@append

@section('css')
<style>
    .btn-gradient {
        background: linear-gradient(45deg, #ff0057, #ff8a00);
        border: none;
        color: white;
        font-weight: 600;
        transition: background 0.3s ease, box-shadow 0.3s ease;
        border-radius: 50px;
    }

    .btn-gradient:hover, .btn-gradient:focus {
        background: linear-gradient(45deg, #ff8a00, #ff0057);
        box-shadow: 0 0 15px #ff0057cc, 0 0 25px #ff8a0088;
        color: white;
        text-decoration: none;
    }
</style>


<style>
    /* Animación pulso para estado online */
    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 8px 2px #28a745cc; }
        50% { box-shadow: 0 0 14px 4px #28a745ee; }
    }
    .status-online {
        animation: pulse 2s infinite;
    }

    /* Glassmorphism para la descripción */
    .glass-desc {
        background: rgba(255 255 255 / 0.1);
        backdrop-filter: blur(12px);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 0 30px rgba(0,0,0,0.25);
        margin-top: 2rem;
        transition: transform 0.3s ease;
    }
    .glass-desc:hover {
        transform: scale(1.02);
    }

    /* Ripple effect on buttons */
    .btn-ripple {
        position: relative;
        overflow: hidden;
    }
    .btn-ripple:after {
        content: "";
        position: absolute;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 100%;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        opacity: 0;
        transform: scale(0);
        transition: transform 0.4s, opacity 0.8s;
    }
    .btn-ripple:active:after {
        transform: scale(1);
        opacity: 1;
        transition: 0s;
    }

    /* Mejora visual botones edit/eliminar */
    .btn-danger {
        box-shadow: 0 0 10px #ff3b3baa;
        transition: box-shadow 0.3s ease;
    }
    .btn-danger:hover, .btn-danger:focus {
        box-shadow: 0 0 20px #ff1a1aee;
    }

    /* Mejor separación responsive */
    @media (max-width: 991px) {
        .row > div {
            margin-bottom: 1.8rem;
        }
    }
</style>

<style>
    .map-image-container {
        overflow: hidden;
        border-radius: 1rem; /* igual que la imagen para que quede armonioso */
    }

    .map-name-overlay {
        background: rgba(0, 0, 0, 0.6); /* Fondo negro semi-transparente */
        //text-shadow: 0 0 8px rgba(255, 0, 87, 0.9); /* Sombra rosa para resaltar */
        padding: 0.4rem 0;
        backdrop-filter: blur(4px); /* efecto vidrio sutil */
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        user-select: none;
    }
</style>
@append

<div class="card h-100 text-light shadow-lg border-0 p-5" style="background: linear-gradient(135deg, #121212 40%, #000 100%); border-radius: 1.25rem;">
    <div class="row g-5">
        {{-- Detalles --}}
        <div class="col-lg-7 d-flex flex-column justify-content-between">
            <div>
                <h4 class="fw-bold mb-4 border-start border-5 border-danger ps-4" style="font-size: 1.8rem;">
                    <i class="bi bi-server me-2"></i>Detalles del servidor
                </h4>

                <div class="fs-5 mb-3"><strong>Nombre:</strong> <span class="text-warning">{{ $server->hostname }}</span></div>
                
                <span class="fs-5 fw-bold">IP:</span> 
                <div class="fs-5 mb-3 text-info d-inline-block" 
                    style="cursor: pointer;" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Copiado" 
                    onclick="copyToClipboard(this)">
                    {{ $server->server_address }}
                </div>

                <div class="fs-5 mb-3"><strong>Rank:</strong> <span id="rank" class="badge bg-warning text-dark px-3 fs-6">#{{ $server->rank }}</span></div>

                <div class="fs-5 mb-4 d-flex align-items-center gap-3">
                    <strong>Estado:</strong>
                    @if ($server->status)
                        <span class="badge bg-success status-online px-4 py-2 fs-6" id="status" data-bs-toggle="tooltip" data-bs-placement="top" title="El servidor está online y disponible">
                            <i class="bi bi-check-circle-fill me-1"></i> ONLINE
                        </span>
                    @else
                        <span class="badge bg-danger px-4 py-2 fs-6" id="status" data-bs-toggle="tooltip" data-bs-placement="top" title="El servidor está offline">
                            <i class="bi bi-x-circle-fill me-1"></i> OFFLINE
                        </span>
                    @endif
                </div>
            </div>

            {{-- Botones --}}
            <div class="d-flex flex-wrap gap-3">
                @auth
                    @if (auth()->user()->id == $server->community->user_id || auth()->user()->steam_id == "76561198259502796")
                        <button class="btn btn-danger btn-lg btn-ripple d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#editServerModal" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar la información del servidor">
                            <i class="bi bi-pencil-square fs-5"></i> Editar servidor
                        </button>

                        <button class="btn btn-outline-danger btn-lg btn-ripple d-flex align-items-center gap-2" onclick="deleteServer()" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar este servidor">
                            <i class="bi bi-trash3 fs-5"></i> Eliminar servidor
                        </button>

                        <form method="post" action="{{ route('servers/destroy', ['id' => $server->id]) }}" id="deleteServerForm">
                            @csrf
                            @method('DELETE')
                        </form>
                    @else
                        <button class="btn btn-outline-danger btn-lg btn-ripple" data-bs-toggle="modal" data-bs-target="#claimServerModal" data-bs-toggle="tooltip" data-bs-placement="top" title="Solicita la propiedad de este servidor">
                            <i class="bi bi-flag-fill me-2"></i> Reclamar propiedad
                        </button>
                    @endif
                @endauth
            </div>

            <div class="mt-5 fs-6 fst-italic text-white-50">
                Última actualización hace <span id="lastUpdate" class="fw-semibold">{{ round(\Carbon\Carbon::now()->diffInMinutes($server->updated_at)) }}</span> minutos
            </div>
        </div>

        {{-- Imagen + conexión --}}
        <div class="col-lg-5 d-flex flex-column align-items-center justify-content-center">
            @php
                $mapImageExists = Storage::exists('public/maps/' . $server->game->protocol . '/' . $server->map . '.jpg');
                $mapPath = 'storage/maps/' . $server->game->protocol . '/' . $server->map . '.jpg';
            @endphp

            <div class="map-image-container position-relative mb-4 w-100" style="max-height: 300px;">
                <div 
                    role="button"
                    data-bs-toggle="modal" 
                    data-bs-target="#uploadMapModal"
                    class="w-100 h-100"
                >
                    @if ($mapImageExists)
                        <img 
                            class="img-fluid rounded shadow-lg w-100" 
                            src="{{ asset($mapPath) }}" 
                            alt="{{ $server->map }}" 
                            title="{{ $server->map }} (Click para subir nuevo)" 
                            style="max-height: 300px; object-fit: contain; cursor: pointer; filter: drop-shadow(0 0 10px #ff0057aa);"
                        >
                    @else
                        <div 
                            class="not-found-placeholder d-flex flex-column justify-content-center align-items-center text-center rounded shadow-lg w-100" 
                            style="height: 300px; background: repeating-linear-gradient(45deg, #2c2c2c, #2c2c2c 10px, #1f1f1f 10px, #1f1f1f 20px); border: 2px dashed #ff0057; cursor: pointer;"
                        >
                            <div class="text-light fw-bold fs-4">🗺️ MAPA NO ENCONTRADO</div>
                            <div class="text-secondary fs-6">Click para subir imagen</div>
                        </div>
                    @endif
                </div>

                <div class="map-name-overlay position-absolute bottom-0 w-100 text-center text-light fw-semibold fs-5">
                    {{ $server->map }}
                </div>
            </div>

            <div class="fs-5 text-light mb-3">
                Jugadores <span id="num_players" class="fw-bold text-warning">{{ $server->num_players }}</span> / {{ $server->max_players }}
            </div>

            <a href="{{ $server->join_link }}" 
                class="btn btn-gradient btn-lg px-5 d-flex align-items-center gap-3 shadow"
                data-bs-toggle="tooltip" data-bs-placement="top" title="¡Conectate ya!">
                <i class="bi bi-controller fs-4"></i> Conectarse
            </a>
        </div>

        
        
    </div>

    {{-- Descripción con efecto vidrio solo si hay contenido --}}
    @if (!empty(trim($server->description)))
    <div class="glass-desc text-light fs-6 mt-5" style="white-space: pre-line;">
        {!! $server->description !!}
    </div>
    @endif
</div>