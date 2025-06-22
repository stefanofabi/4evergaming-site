<div class="mb-5">
    <h2 class="text-light mb-3">👥 Comunidades Activas</h2>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($communities->take(4) as $community)
            <div class="col">
                <div class="card h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
                    <div class="row g-0 h-100">
                        {{-- Columna izquierda: Logo --}}
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            <a href="{{ route('communities/show', ['slug' => $community->slug]) }}">
                                <img src="{{ asset('storage/communities/' . $community->logo) }}" class="img-fluid rounded" alt="{{ $community->name }} Logo">
                            </a>
                        </div>

                        {{-- Columna derecha: Contenido + redes abajo --}}
                        <div class="col-md-8 d-flex flex-column justify-content-between p-3">
                            <div>
                                <h5 class="card-title">{{ $community->name }}</h5>
                                <p class="card-text">{{ Str::limit($community->description, 120) }}</p>
                            </div>
                            <div class="text-end mt-2">
                                @if($community->instagram)
                                    <a href="{{ $community->instagram }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Instagram">
                                        <i class="bi bi-instagram fs-5"></i>
                                    </a>
                                @endif
                                
                                @if($community->youtube)
                                    <a href="{{ $community->youtube }}" target="_blank" class="text-light ms-2 text-decoration-none" title="YouTube">
                                        <i class="bi bi-youtube fs-5"></i>
                                    </a>
                                @endif

                                @if($community->discord)
                                    <a href="{{ $community->discord }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Discord">
                                        <i class="bi bi-discord fs-5"></i>
                                    </a>
                                @endif

                                @if($community->tiktok)
                                    <a href="{{ $community->tiktok }}" target="_blank" class="text-light ms-2 text-decoration-none" title="TikTok">
                                        <i class="bi bi-tiktok fs-5"></i>
                                    </a>
                                @endif

                                @if($community->website)
                                    <a href="{{ $community->website }}" target="_blank" class="text-light ms-2 text-decoration-none" title="Sitio Web">
                                        <i class="bi bi-globe2 fs-5"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>