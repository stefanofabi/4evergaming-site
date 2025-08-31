@extends('gametracker.base')

@section('title', '4evergaming: Torneos')
@section('description', 'Participa de los torneos más emocionantes')
@section('robots', 'index, follow')

@section('css')
<style>
    body {
        background-color: #0b0b0b;
        color: #fff;
        font-family: 'Orbitron', sans-serif;
    }

    .tournaments-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .section-title {
        font-size: 2rem;
        color: #ff1c1c;
        margin-bottom: 1rem;
        text-transform: uppercase;
        border-bottom: 2px solid #ff1c1c;
        padding-bottom: 0.5rem;
    }

    .tournament-card {
        background: #1a1a1a;
        border: 2px solid #ff1c1c;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: transform 0.2s ease-in-out;
    }

    .tournament-card:hover {
        transform: scale(1.02);
    }

    .tournament-card h3 {
        color: #fff;
        margin-bottom: 0.5rem;
    }

    .tournament-card p {
        margin: 0.5rem 0;
    }

    .btn-register {
        background: #ff1c1c;
        color: #fff;
        padding: 0.5rem 1rem;
        text-transform: uppercase;
        font-weight: bold;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-register:hover {
        background: #ff4646;
    }

    .tournament-section {
        margin-top: 3rem;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.9);
    }

    .modal-content {
        background-color: #1a1a1a;
        margin: auto;
        padding: 2rem;
        border: 2px solid #ff1c1c;
        width: 80%;
        max-width: 500px;
        border-radius: 10px;
        color: #fff;
    }

    .close {
        color: #ff1c1c;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    input[type="text"], input[type="email"] {
        width: 100%;
        padding: 0.5rem;
        background-color: #111;
        border: 1px solid #ff1c1c;
        color: white;
        border-radius: 4px;
    }

    .btn-gamer-dark {
        background-color: #0f0f0f;
        color: #ff1c1c;
        padding: 0.75rem 1.5rem;
        font-family: 'Orbitron', sans-serif;
        font-size: 1rem;
        text-transform: uppercase;
        border: 2px solid #ff1c1c;
        border-radius: 6px;
        letter-spacing: 1px;
        box-shadow: 0 0 10px rgba(255, 28, 28, 0.3);
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .btn-gamer-dark::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255,28,28,0.4), transparent);
        transition: left 0.5s ease;
        z-index: 1;
    }

    .btn-gamer-dark:hover::after {
        left: 100%;
    }

    .btn-gamer-dark:hover {
        background-color: #1a1a1a;
        box-shadow: 0 0 15px rgba(255, 28, 28, 0.5), 0 0 30px rgba(255, 28, 28, 0.3);
        transform: scale(1.05);
        color: #fff;
    }

    .btn-inscribirse-gamer {
        background: linear-gradient(45deg, #ff1c1c, #ff6f00);
        color: #fff;
        padding: 0.75rem 1.5rem;
        font-family: 'Orbitron', sans-serif;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid #ff1c1c;
        border-radius: 8px;
        box-shadow: 0 0 10px #ff1c1c, 0 0 20px #ff6f00;
        transition: all 0.2s ease-in-out;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .btn-inscribirse-gamer::before {
        content: "";
        position: absolute;
        top: -100%;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.15);
        transform: skewY(45deg);
        transition: top 0.3s ease;
        z-index: -1;
    }

    .btn-inscribirse-gamer:hover::before {
        top: 100%;
    }

    .btn-inscribirse-gamer:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px #ff1c1c, 0 0 30px #ff6f00;
        border-color: #ff6f00;
        cursor: pointer;
    }


</style>

<style>
    /* Gamer style */
    .modal-content.gamer-style {
        background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
        border: 2px solid #ff004d;
        box-shadow: 0 0 25px #ff004d;
        color: #ffffff;
        font-family: 'Orbitron', sans-serif; /* Puedes importar Orbitron desde Google Fonts */
    }

    .modal-header.gamer-style {
        border-bottom: 1px solid #ff004d;
    }

    .modal-title.gamer-style {
        color: #ff004d;
        text-shadow: 0 0 5px #ff004d;
    }

    .btn-danger.gamer-style {
        background-color: #ff004d;
        border-color: #ff004d;
        box-shadow: 0 0 10px #ff004d;
        transition: all 0.2s ease-in-out;
    }

    .btn-danger.gamer-style:hover {
        background-color: #ff3366;
        box-shadow: 0 0 15px #ff004d;
    }

    .form-control, .form-select {
        background-color: #1c1c1c;
        color: #ffffff;
        border: 1px solid #ff004d;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 10px #ff004d;
        border-color: #ff004d;
    }

    .btn-close-white {
        filter: invert(1);
    }

    label.form-label {
        color: #ffcccc;
    }
</style>
@endsection

@section('javascript')
@parent

@endsection

@section('content')
<div class="tournaments-container">
    @auth
        <div class="tournament-section mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title m-0 w-50">Mis Torneos</h2>
                <button type="button" class="btn-gamer-dark" data-bs-toggle="modal" data-bs-target="#createTournamentModal">
                    + Crear Torneo
                </button>

            </div>

            @if ($my_tournaments->isEmpty())
                <div class="alert alert-info">
                    No has creado ningún torneo todavía.
                </div>
            @else
                <div class="list-group">
                    @foreach ($my_tournaments as $tournament)
                        <a href="{{ route('tournaments/show', ['slug' => $tournament->slug]) }}" class="list-group-item list-group-item-action">
                            <strong>{{ $tournament->name }}</strong> <br>
                            <small class="text-muted">Creado el {{ $tournament->created_at->format('d/m/Y') }}</small>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endauth


    <div class="section-title">Torneos Activos</div>

    @forelse ($upcoming_tournaments as $tournament)
        <div class="tournament-card">
            <h3>{{ $tournament->name }}</h3>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($tournament->start_date)->format('d/m/Y') }}</p>
            @if ($tournament->prize) <p><strong>Premio:</strong> ${{ $tournament->prize }}</p> @endif
            
            <form action="{{ route('tournaments/show', ['slug' => $tournament->slug]) }}" method="GET" style="display: inline;">
                @csrf
                
                <button type="submit" class="btn-inscribirse-gamer">Mas informacion</button>
            </form>
        </div>
    @empty
        <p>No hay torneos activos en este momento.</p>
    @endforelse

    <div class="tournament-section">
        <div class="section-title">Últimos Torneos</div>

        <!-- Torneos completados dinámicos -->
        @forelse ($completed_tournaments as $tournament)
            <div class="tournament-card">
                <h3>{{ $tournament->name }}</h3>
                <p><strong>Ganador:</strong> {{ $tournament->winner_name ?? 'Pendiente' }}</p>
                @if ($tournament->prize) <p><strong>Premio:</strong> ${{ $tournament->prize }}</p> @endif
            </div>
        @empty
            <p>No hay torneos finalizados todavía.</p>
        @endforelse
    </div>
</div>

@include('gametracker.tournaments.create')

@endsection
