@if ($myCommunity)
<div class="col-md-4 mb-4">
    <div class="card h-100 shadow-lg rounded bg-light text-dark">
        <a href="{{ route('communities/show', $myCommunity->id) }}">
            <img src="{{ asset('storage/communities/' . $myCommunity->logo) }}?t={{ strtotime($myCommunity->updated_at) }}" class="card-img-top" alt="{{ $myCommunity->name }}">
        </a>
        <div class="card-body d-flex flex-column mt-3">
            <h5 class="card-title">{{ $myCommunity->name }}</h5>
            <p class="card-text text-muted">
                @if ($myCommunity->description)
                    {{ Str::limit($myCommunity->description, 120) }}
                @endif
            </p>

             <!-- Redes Sociales -->
             <div class="social-icons mt-3">
              @if ($myCommunity->whatsapp)
                  <a href="https://wa.me/{{ $myCommunity->whatsapp }}" target="_blank" title="WhatsApp">
                      <i class="bi bi-whatsapp"></i>
                  </a>
              @endif
              @if ($myCommunity->instagram)
                  <a href="https://www.instagram.com/{{ $myCommunity->instagram }}" target="_blank" title="Instagram">
                      <i class="bi bi-instagram"></i>
                  </a>
              @endif
              @if ($myCommunity->tiktok)
                  <a href="https://www.tiktok.com/@{{ $myCommunity->tiktok }}" target="_blank" title="TikTok">
                      <i class="bi bi-tiktok"></i>
                  </a>
              @endif
              @if ($myCommunity->youtube)
                  <a href="https://www.youtube.com/{{ $myCommunity->youtube }}" target="_blank" title="YouTube">
                      <i class="bi bi-youtube"></i>
                  </a>
              @endif
              @if ($myCommunity->website)
                  <a href="{{ $myCommunity->website }}" target="_blank" title="Sitio Web">
                      <i class="bi bi-globe"></i>
                  </a>
              @endif
            </div>

        </div>
    </div>
</div>
@else
<div class="col-md-4 mb-4">
    <div class="card h-100 shadow-lg rounded bg-light text-dark">
        <img src="{{ asset('storage/communities/default.png') }}" class="card-img-top" alt="Imagen por defecto">
        <div class="card-body d-flex flex-column mt-3">
            <h5 class="card-title">Agregar Comunidad</h5>
            <p class="card-text text-muted">
                No tenes una comunidad asociada. Agrega una comunidad para comenzar.
            </p>
            
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addCommunityModal">
                <i class="bi bi-plus-circle"></i> Agregar Comunidad
            </button>
        </div>
    </div>
</div>
@endif
