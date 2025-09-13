@extends('gametracker.base')

@section('description', "Perfil de jugador profesional: {$user->name}")
@section('robots', 'index, follow')
@section('title')
Perfil Gamer - {{ $user->name }} | 4evergaming
@endsection

@section('css')
<!-- Bootstrap Icons (por si no lo tenés aún) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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

    /* Avatar estilo hover gamer */
    a:hover img {
        transform: scale(1.05);
        transition: transform 0.2s ease-in-out;
        box-shadow: 0 0 10px #1f6feb;
    }

    /* Badges estilo gamer */
    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
    }

    /* Botones estilo futuro */
    .btn-primary {
        background-color: #1f6feb;
        border: none;
    }

    .btn-primary:hover {
        background-color: #265dc1;
    }

    /* Placeholder para comentarios y equipo vacíos */
    .text-muted {
        color: #8b949e !important;
    }

    /* Links */
    a {
        color: #58a6ff;
    }

    a:hover {
        color: #1f6feb;
        text-decoration: underline;
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
            <strong><i class="bi bi-people-fill me-1"></i>Mi equipo</strong>
        </div>
        <div class="card-body">
            {{-- Placeholder (hasta que conectes Team model) --}}
            <p class="text-muted mb-0">Este jugador aún no se ha unido a un equipo.</p>
        </div>
    </div>

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
