    <div class="container mt-4">
        <!-- <h3 class="text-light mb-3">➡️ Comunidad</h3> -->
        <div class="row row-cols-1 row-cols-md-1 g-4">
            <div class="col">
                <div class="card h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
                    <div class="row g-0 h-100">
                        {{-- Columna izquierda: Logo --}}
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            <a href="{{ route('communities/show', ['slug' => $server->community->slug]) }}">
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
                            <div class="text-start mt-2">
                                @if($server->community->instagram)
                                    <a href="http://instagram.com/{{ $server->community->instagram }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Instagram">
                                        <i class="bi bi-instagram fs-3"></i>
                                    </a>
                                @endif
                                @if($server->community->youtube)
                                    <a href="http://youtube.com/channel/{{ $server->community->youtube }}" target="_blank" class="text-light ms-2 text-decoration-none" title="YouTube">
                                        <i class="bi bi-youtube fs-3"></i>
                                    </a>
                                @endif
                                @if($server->community->discord)
                                    <a href="http://discord.gg/{{ $server->community->discord }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Discord">
                                        <i class="bi bi-discord fs-3"></i>
                                    </a>
                                @endif
                                @if($server->community->tiktok)
                                    <a href="http://tiktok.com/{{ '@' . $server->community->tiktok }}" target="_blank" class="text-light ms-2 text-decoration-none" title="TikTok">
                                        <i class="bi bi-tiktok fs-3"></i>
                                    </a>
                                @endif
                                @if($server->community->website)
                                    <a href="{{ $server->community->website }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Sitio Web">
                                        <i class="bi bi-globe2 fs-3"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>