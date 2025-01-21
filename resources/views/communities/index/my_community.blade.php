@php
$community = auth()->user()->community()->first();    
@endphp

@if ($community)
<div class="col-md-4 mb-4">
    <div class="card h-100 shadow-lg rounded bg-light text-dark">
        <a href="{{ route('communities/show', $community->id) }}">
            <img src="{{ asset('storage/communities/' . $community->logo) }}" class="card-img-top" alt="{{ $community->name }}">
        </a>
        <div class="card-body d-flex flex-column mt-3">
            <h5 class="card-title">{{ $community->name }}</h5>
            <p class="card-text text-muted">
                @if ($community->description)
                    {{ Str::limit($community->description, 120) }}
                @endif
            </p>

             <!-- Redes Sociales -->
             <div class="social-icons mt-3">
              @if ($community->whatsapp)
                  <a href="https://wa.me/{{ $community->whatsapp }}" target="_blank" title="WhatsApp">
                      <i class="bi bi-whatsapp"></i>
                  </a>
              @endif
              @if ($community->instagram)
                  <a href="https://www.instagram.com/{{ $community->instagram }}" target="_blank" title="Instagram">
                      <i class="bi bi-instagram"></i>
                  </a>
              @endif
              @if ($community->tiktok)
                  <a href="https://www.tiktok.com/@{{ $community->tiktok }}" target="_blank" title="TikTok">
                      <i class="bi bi-tiktok"></i>
                  </a>
              @endif
              @if ($community->youtube)
                  <a href="https://www.youtube.com/{{ $community->youtube }}" target="_blank" title="YouTube">
                      <i class="bi bi-youtube"></i>
                  </a>
              @endif
              @if ($community->website)
                  <a href="{{ $community->website }}" target="_blank" title="Sitio Web">
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
