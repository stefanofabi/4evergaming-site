@extends('base')

@section('javascript')
    @parent
@endsection

@section('robots', 'index, follow')

@section('title', '4evergaming: Listado de Comunidades')

@section('description', 'Explora las comunidades más divertidas y emocionantes.')

@section('css')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

.card {
    border: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    width: 100%;
    height: 400px;
    object-fit: cover;
    margin: 0 auto;
    display: block;
}

.card-body {
    background-color: #f9f9f9;
}

.card-title {
    font-size: 1.2rem;
    font-weight: bold;
}

.card-text {
    font-size: 0.9rem;
}

.btn-info {
    transition: background-color 0.3s ease;
}

.btn-info:hover {
    background-color: #17a2b8;
}

.social-icons {
    font-size: 1.5rem;
}

.social-icons a {
    margin-right: 10px;
    color: #333;
    text-decoration: none;
}

.social-icons a:hover {
    color: #17a2b8;
}

</style>
@append

@section('content')

@php
    $myCommunity = auth()->check() ? auth()->user()->community()->first() : null;
@endphp

<div class="container mt-5">
  <h1 class="text-center mb-4">¡Explora Nuestras Comunidades!</h1>

  <div class="row">
    @include('communities.index.my_community', ['myCommunity' => $myCommunity])
    
      @foreach ($communities as $community)
        @if ($myCommunity && $myCommunity->id === $community->id) @continue @endif

          <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-lg rounded">
                  <a href="{{ route('communities/show', $community->id) }}">
                      <img src="{{ asset('storage/communities/' . $community->logo) }}?t={{ strtotime($community->updated_at) }}" class="card-img-top" alt="{{ $community->name }}">
                  </a>
                  <div class="card-body d-flex flex-column mt-3">
                      <h5 class="card-title text-dark">{{ $community->name }}</h5>
                      <p class="card-text text-muted">
                          @if ($community->description)
                              {{ Str::limit($community->description, 120) }}
                          @endif
                      </p>

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
                            <a href="https://www.tiktok.com/{{ "@". $community->tiktok }}" target="_blank" title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        @endif

                        @if ($community->youtube)
                            <a href="https://www.youtube.com/{{ $community->youtube }}" target="_blank" title="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                        @endif

                        @if ($community->discord)
                            <a href="https://discord.gg/{{ $community->discord }}" target="_blank" title="Discord">
                                <i class="bi bi-discord"></i>
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
      @endforeach
  </div>
</div>

@include('communities.create')

@endsection