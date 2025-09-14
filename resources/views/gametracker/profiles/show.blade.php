@extends('gametracker.base')

@section('description', "Perfil de jugador profesional: {$user->name}")
@section('robots', 'index, follow')
@section('title')
Perfil Gamer - {{ $user->name }} | 4evergaming
@endsection

@section('css')
<!-- Bootstrap Icons (por si no lo tenés aún) -->
<style>
    /* Fondo general oscuro estilo gamer */
    body {
        background-color: #0e0e10;
        color: #e4e4e7;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Tarjetas con fondo oscuro */
    .card {
        background-color: #1a1c20;
        border: none;
        border-radius: 8px;
    }

    .card-header {
        background-color: #121417;
        border-bottom: 1px solid #2a2d34;
        color: #ffffff;
        font-weight: bold;
    }

    .card-body {
        color: #dcdcdc;
    }

    /* Badges estilo gamer */
    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
    }

    /* Placeholder para comentarios y equipo vacíos */
    .text-muted {
        color: #8b949e !important;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">

    {{-- ⚫ Header de Perfil con fondo oscuro estilo gamer --}}
    <div class="card bg-dark text-white mb-4 shadow-lg">
        <div class="card-body d-flex align-items-center">
            {{-- Avatar con marco y link a Steam --}}
            <a href="{{ $user->profile_url }}" target="_blank" rel="noopener" class="me-4">
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                    class="rounded-circle border border-3 border-secondary"
                    style="width: 80px; height: 80px; object-fit: cover;">
            </a>

            {{-- Info principal del jugador --}}
            <div>
                <h3 class="mb-0">{{ $user->name }}</h3>
                <small class="text-muted">Steam ID: {{ $user->steam_id }}</small><br>
                <span class="badge bg-primary mt-2 me-2">
                    <i class="bi bi-globe2"></i>
                    {{ $user->country_code ?? 'Sin país' }}
                </span>

                @if($user->banned_at)
                    <span class="badge bg-danger mt-2">🚫 Baneado desde {{ $user->banned_at->format('d/m/Y') }}</span>
                @else
                    <span class="badge bg-success mt-2">✔ Jugador Activo</span>
                @endif
            </div>
        </div>
    </div>

    {{-- 🛡️ Sección: Mi equipo --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <strong><i class="bi bi-people-fill me-1 text-danger"></i>Mi equipo</strong>
        </div>
        <div class="card-body">

            @if(!$user->team)
                <p class="text-muted">Aún no te uniste a un equipo.</p>

                {{-- Botón para crear equipo --}}
                <button class="btn btn-outline-danger btn-sm mb-3" onclick="document.getElementById('create-team-form').classList.toggle('d-none')">
                    ¿Querés crear tu propio equipo?
                </button>

                {{-- Formulario de creación --}}
                <form id="create-team-form" class="d-none mt-3" method="POST" action="{{ route('teams/store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3" style="max-width: 500px;">
                        <label for="teamName" class="form-label text-light">Nombre del equipo</label>
                        <input type="text" name="name" id="teamName"
                            class="form-control bg-dark text-white border border-danger"
                            placeholder="Ej: Red Demons" required>
                    </div>

                    <div class="mb-3" style="max-width: 500px;">
                        <label for="teamLogo" class="form-label text-light">Logo del equipo</label>
                        <input type="file" name="logo" id="teamLogo"
                            class="form-control bg-dark text-white border border-danger"
                            accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-danger">🔥 Crear equipo</button>
                </form>
            @else
                <div class="d-flex align-items-start">
                    {{-- Logo del equipo --}}
                    <a href="{{ route('teams/show', ['slug' => $user->team->slug]) }}"> 
                        <img src="{{ asset('storage/teams/logos/' . $user->team->logo) }}"
                            alt="{{ $user->team->name }}"
                            class="rounded border border-danger me-4"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        </a>
                    <div>
                        <h5 class="mb-1 text-white">{{ $user->team->name }}</h5>
                    </div>
                </div>
            @endif

        </div>
    </div>


    {{-- 🌐 Sección: Mi Comunidad --}}
    @if($user->community)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <strong><i class="bi bi-house-door-fill me-1"></i>Mi Comunidad</strong>
            </div>
            <div class="card-body d-flex align-items-start">
                {{-- Logo de la comunidad --}}
                <a href="{{ route('communities/show', ['slug' => $user->community->slug]) }}"> 
                    <img src="{{ asset('storage/communities/' . $user->community->logo) }}"
                        alt="{{ $user->community->name }}"
                        class="rounded me-4"
                        style="max-width: 200px; object-fit: cover;">
                </a>

                <div>
                    <h5 class="mb-1">{{ $user->community->name }}</h5>
                    <p class="mb-2 text-muted" style="max-width: 100%;">
                        {{ Str::limit($user->community->description, 200, '...') }}
                    </p>

                    {{-- Calificación --}}
                    <span class="badge bg-warning text-dark me-2">
                        ⭐ {{ number_format($user->community->calification, 1) }}/5
                    </span>

                    <br /> <br /> <br /> 

                    {{-- Redes sociales --}} 
                    <div class="mt-2">
                        @if($user->community->discord)
                            <a href="{{ $user->community->discord }}" target="_blank" class="me-2 text-decoration-none" title="Discord">
                                <i class="bi bi-discord fs-4 text-light"></i>
                            </a>
                        @endif
                        @if($user->community->instagram)
                            <a href="{{ $user->community->instagram }}" target="_blank" class="me-2 text-decoration-none" title="Instagram">
                                <i class="bi bi-instagram fs-4 text-light"></i>
                            </a>
                        @endif
                        @if($user->community->tiktok)
                            <a href="{{ $user->community->tiktok }}" target="_blank" class="me-2 text-decoration-none" title="TikTok">
                                <i class="bi bi-tiktok fs-4 text-light"></i>
                            </a>
                        @endif
                        @if($user->community->youtube)
                            <a href="{{ $user->community->youtube }}" target="_blank" class="me-2 text-decoration-none" title="YouTube">
                                <i class="bi bi-youtube fs-4 text-light"></i>
                            </a>
                        @endif
                        @if($user->community->whatsapp)
                            <a href="{{ $user->community->whatsapp }}" target="_blank" class="me-2 text-decoration-none" title="WhatsApp">
                                <i class="bi bi-whatsapp fs-4 text-light"></i>
                            </a>
                        @endif
                        @if($user->community->website)
                            <a href="{{ $user->community->website }}" target="_blank" class="me-2 text-decoration-none" title="Sitio Web">
                                <i class="bi bi-globe fs-4 text-light"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- 💬 Sección: Comentarios --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <strong><i class="bi bi-chat-dots me-1"></i>Comentarios del perfil</strong>
        </div>
        <div class="card-body">
            {{-- Placeholder de comentarios --}}
            <p class="text-muted">No hay comentarios aún.</p>
            {{-- Futuro: formulario para comentar --}}
            <form method="POST" action="#">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" name="comment" rows="3" placeholder="Escribe un comentario..."></textarea>
                </div>
                <button class="btn btn-danger" disabled>Enviar (próximamente)</button>
            </form>
        </div>
    </div>

</div>
@endsection
