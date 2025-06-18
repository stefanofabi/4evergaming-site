@if ($myCommunity)
    <div class="col">
        <div class="card h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
            <div class="row g-0 h-100">
                {{-- Logo --}}
                <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                    <a href="{{ route('communities/show', $myCommunity->id) }}">
                        <img src="{{ asset('storage/communities/' . $myCommunity->logo) }}?t={{ strtotime($myCommunity->updated_at) }}" class="img-fluid rounded" alt="{{ $myCommunity->name }}">
                    </a>
                </div>

                {{-- Contenido + Redes --}}
                <div class="col-md-8 d-flex flex-column justify-content-between p-3">
                    <div>
                        <h5 class="card-title">{{ $myCommunity->name }}</h5>
                        <p class="card-text text-light">
                            {!! Str::limit(strip_tags($myCommunity->description), 120) !!}
                        </p>
                    </div>
                    <div class="text-end mt-2">
                        @if ($myCommunity->whatsapp)
                            <a href="https://wa.me/{{ $myCommunity->whatsapp }}" target="_blank" title="WhatsApp" class="text-light ms-2 text-decoration-none">
                                <i class="bi bi-whatsapp fs-5"></i>
                            </a>
                        @endif
                        @if ($myCommunity->instagram)
                            <a href="https://www.instagram.com/{{ $myCommunity->instagram }}" target="_blank" title="Instagram" class="text-light ms-2 text-decoration-none">
                                <i class="bi bi-instagram fs-5"></i>
                            </a>
                        @endif
                        @if ($myCommunity->tiktok)
                            <a href="https://www.tiktok.com/@{{ $myCommunity->tiktok }}" target="_blank" title="TikTok" class="text-light ms-2 text-decoration-none">
                                <i class="bi bi-tiktok fs-5"></i>
                            </a>
                        @endif
                        @if ($myCommunity->youtube)
                            <a href="https://www.youtube.com/{{ $myCommunity->youtube }}" target="_blank" title="YouTube" class="text-light ms-2 text-decoration-none">
                                <i class="bi bi-youtube fs-5"></i>
                            </a>
                        @endif
                        @if ($myCommunity->website)
                            <a href="{{ $myCommunity->website }}" target="_blank" title="Sitio Web" class="text-light ms-2 text-decoration-none">
                                <i class="bi bi-globe2 fs-5"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Card sin comunidad asociada --}}
    <div class="col">
        <div class="card h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #333 30%, #111 100%);">
            <div class="row g-0 h-100">
                {{-- Imagen por defecto --}}
                <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                    <img src="{{ asset('storage/communities/default.png') }}" class="img-fluid rounded" alt="Imagen por defecto">
                </div>

                {{-- Contenido con CTA --}}
                <div class="col-md-8 d-flex flex-column justify-content-between p-3">
                    <div>
                        <h5 class="card-title">No tenés una comunidad asociada</h5>
                        <p class="card-text text-light">
                            Agregá una comunidad para comenzar.
                        </p>
                    </div>
                    
                    <!-- 
                    <div class="text-end mt-2">
                        <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#addCommunityModal">
                            <i class="bi bi-plus-circle"></i> Agregar Comunidad
                        </button>
                    </div>
                    -->

                </div>
            </div>
        </div>
    </div>
@endif