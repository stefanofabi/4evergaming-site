@extends('gametracker.base')

@section('title', '4evergaming: '.$tournament->name)
@section('description', 'Participa de los torneos más emocionantes')
@section('robots', 'index, follow')

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">

<style>
  .gamer-container {
    color: #e6e6e6;
  }

  .gamer-header {
    background: #1a1a1a;
    border-bottom: 3px solid #ff0000;
    padding: 1rem;
    text-align: center;
  }

    .gamer-header h1 {
        font-family: 'Orbitron', sans-serif;
        color: #ff0000;
        text-shadow: 0 0 8px #ff0000;
        font-size: 2.5rem;
    }

  .tournament-card {
    background: #1a1a1a;
    border: 2px solid #ff0000;
    box-shadow: 0 0 20px #ff0000;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 2rem;
  }

  .tournament-card img {
    width: 100%;
    border-bottom: 2px solid #ff0000;
    max-height: 300px;
    object-fit: cover;
  }

  .tournament-details {
    padding: 1.5rem;
  }

  .detail-label {
    font-weight: bold;
    color: #ff3333;
    width: 160px;
    display: inline-block;
  }

  .participants-section {
    background: #1a1a1a;
    border: 2px solid #ff0000;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 0 10px #ff0000;
  }

  .participant-item {
    padding: 0.5rem;
    border-bottom: 1px solid #ff0000;
  }

  .participant-item:last-child {
    border-bottom: none;
  }

  @media (max-width: 768px) {
    .gamer-header h1 {
      font-size: 2rem;
    }
    .detail-label {
      display: block;
      width: auto;
      margin-bottom: 0.25rem;
    }
  }
</style>

<style>
  /* Premio destacado */
  .tournament-prize {
        font-family: 'Orbitron', sans-serif;
        background: linear-gradient(135deg, #ff0000, #8b0000);
        color: #fff;
        font-size: 1.8rem;
        font-weight: bold;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 2rem;
        box-shadow: 0 0 20px #ff0000;
        text-shadow: 0 0 5px #000;
    }

  /* Estado destacado */
  .tournament-status {
    position: absolute;
    //top: 5px;
    right: 10px;
    background-color: #ff0000;
    color: #fff;
    padding: 0.5rem 1.2rem;
    font-weight: bold;
    border-radius: 0 0 0 15px;
    box-shadow: 0 0 10px #ff0000;
    font-size: 1rem;
    z-index: 10;
    }


  /* Fechas gráficas */
  .tournament-dates {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-bottom: 1.5rem;
    gap: 1rem;
  }

    .tournament-dates .date-box h4 {
        font-size: 1.5rem; /* Puedes ajustar este tamaño */
        font-weight: 700;  /* Para que se vean más fuertes */
        margin-bottom: 0.5rem; /* Un poco de espacio debajo del título */
    }

  .date-box {
    flex: 1;
    min-width: 150px;
    background: #111;
    border: 2px solid #ff0000;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 0 10px #ff0000;
  }

  .date-box h4 {
    color: #ff3333;
    font-size: 1.1rem;
  }

  .date-box p {
    font-size: 1.3rem;
    margin: 0;
  }

  @media (max-width: 576px) {
    .tournament-status {
      font-size: 0.9rem;
      top: -15px;
      right: 0;
    }

    .tournament-prize {
      font-size: 1.5rem;
    }
  }

  .gamer-signup-btn {
    background: linear-gradient(45deg, #ff0000, #ff6600, #ff0000);
    color: #fff;
    font-family: 'Orbitron', sans-serif;
    font-size: 1.4rem;
    font-weight: bold;
    padding: 0.8rem 2rem;
    border: 3px solid #fff;
    border-radius: 12px;
    text-shadow: 0 0 5px #000;
    box-shadow: 0 0 15px #ff0000, 0 0 10px #ff6600 inset;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-block;
    }

    .gamer-signup-btn:hover {
        background: linear-gradient(45deg, #ff6600, #ff0000, #ff6600);
        box-shadow: 0 0 25px #ff6600, 0 0 15px #ff0000 inset;
        transform: scale(1.05);
        color: #ffffff;
    }
</style>
@endsection

@section('javascript')
@parent
<script>
  function confirmRegistration() {
    return confirm('¿Estás seguro que quieres inscribirte en este torneo?');
  }
</script>
@endsection

@section('content')
<div class="container gamer-container my-5 position-relative">

  {{-- Estado del torneo --}}
  <div class="tournament-status">
    {{ ucfirst($tournament->status) }}
  </div>

  {{-- Título principal --}}
  <div class="gamer-header mb-4">
    <h1>{{ $tournament->name }}</h1>
  </div>

  {{-- Premio destacado --}}
  @if($tournament->prize)
    <div class="tournament-prize">
      🏆 Premio: ${{ number_format($tournament->prize, 0, ',', '.') }}
    </div>
  @endif

<div class="tournament-dates">
    <div class="date-box">
        <h4>📅 Fechas</h4>
        <p>
            @if($tournament->start_date)
                {{ \Carbon\Carbon::parse($tournament->start_date)->format('d M Y') }}
                
                @if($tournament->end_date)
                    &nbsp;→&nbsp;{{ \Carbon\Carbon::parse($tournament->end_date)->format('d M Y') }}
                @endif
                
            @else
                —
            @endif
        </p>
    </div>


    @if($tournament->max_participants)
        @php
            $currentParticipants = $tournament->participants->count();
            $remainingSpots = $tournament->max_participants - $currentParticipants;
        @endphp
        <div class="date-box">
            <h4>🎮 Espacios disponibles</h4>
            <p>{{ $remainingSpots > 0 ? $remainingSpots : 0 }}</p>
        </div>
    @endif

    @if($tournament->organizer)
        <div class="date-box">
            <h4>👑 Organizador</h4>
            <p>{{ $tournament->organizer->name }}</p>
        </div>
    @endif
</div>

{{-- Imagen + Descripción --}}
<div class="tournament-card row no-gutters p-3 mb-4 rounded shadow-sm" style="background-color: #1c1c1c; color: #f8f9fa;">
  @if($tournament->tournament_image)
    <div class="col-md-4 mb-3 mb-md-0">
      <img src="{{ asset('storage/tournaments/' . $tournament->tournament_image) }}" alt="Imagen de {{ $tournament->name }}" class="img-fluid rounded">
    </div>
  @endif

  <div class="{{ $tournament->tournament_image ? 'col-md-8' : 'col-12' }}">
    <div class="tournament-details">

      {{-- Descripción --}}
      @if($tournament->description)
        <p class="mb-3">{{ $tournament->description }}</p>
      @endif

      {{-- Detalles dinámicos --}}
      <ul class="list-unstyled">
        @if($tournament->type)
          <li><strong>Tipo:</strong> {{ ucfirst($tournament->type) }}</li>
        @endif

        @if($tournament->location)
          <li><strong>Ubicación:</strong> {{ $tournament->location }}</li>
        @endif

        @if($tournament->max_participants)
          <li><strong>Participantes Máx.:</strong> {{ $tournament->max_participants }}</li>
        @endif

        @if($tournament->entry_fee)
          <li><strong>Cuota de inscripción:</strong> ${{ number_format($tournament->entry_fee, 2, ',', '.') }}</li>
        @endif
      </ul>

      <div class="d-flex flex-wrap gap-3 mt-4 align-items-center">
        @if($tournament->event_url)
          <a href="{{ $tournament->event_url }}" class="gamer-signup-btn text-decoration-none" target="_blank">
            🎫 Ver Evento
          </a>
        @endif

        @if($tournament->status === 'upcoming')
          @if($isRegistered)
            <button type="button" class="gamer-signup-btn" disabled>
              ✅ Ya estás inscripto
            </button>
          @else
            <form id="register-form" action="{{ route('tournaments/register', $tournament->id) }}" method="POST" onsubmit="return confirmRegistration()">
              @csrf
              <button type="submit" class="gamer-signup-btn">
                🔥 ¡Inscribirme Ahora!
              </button>
            </form>
          @endif
        @endif

      </div>

    </div>
  </div>
</div>


{{-- Participantes --}}
<div class="participants-section mt-4">
  <h2 class="text-danger" style="text-shadow: 0 0 5px #ff0000;">👥 Participantes</h2>
  @if($tournament->participants && $tournament->participants->count())
    <div class="participant-list mt-3">
      <div class="participant-header d-flex fw-bold border-bottom pb-2 mb-2">
        <div class="flex-grow-1">Jugador</div>
        <div style="width: 80px" class="text-center">Puntos</div>
        @if (auth()->user() && $tournament->organizer_id == auth()->user()->id)
          <div style="width: 150px;" class="text-center">Acciones</div>
        @endif
      </div>

      
      @foreach($tournament->participants->sortByDesc('points') as $participant)
        <div class="participant-item d-flex mb-1 align-items-center">
          <div class="flex-grow-1 d-flex align-items-center">
            @if($participant->user->avatar)
              @if($participant->user->profile_url)
                <a href="{{ $participant->user->profile_url }}" target="_blank" rel="noopener noreferrer" style="display: inline-block; margin-right: 10px;">
                  <img src="{{ $participant->user->avatar }}" alt="Avatar de {{ $participant->user->name }}" 
                      style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                </a>
              @else
                <img src="{{ $participant->user->avatar }}" alt="Avatar de {{ $participant->user->name }}" 
                    style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
              @endif
            @endif
            {{ $participant->user->name }}
          </div>

          <div style="width: 80px;" class="text-center">{{ $participant->points }}</div>

          @if (auth()->user() && $tournament->organizer_id == auth()->user()->id)
            <div style="width: 150px;" class="text-center d-flex justify-content-center gap-2">
              {{-- Botón sumar punto --}}
              <form action="{{ route('tournaments/participants/increment', [$tournament->id, $participant->id]) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-success btn-sm" title="Sumar punto">+</button>
              </form>

              {{-- Botón restar punto --}}
              <form action="{{ route('tournaments/participants/decrement', [$tournament->id, $participant->id]) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-warning btn-sm" title="Restar punto">−</button>
              </form>

              {{-- Botón borrar participante --}}
              <form action="{{ route('tournaments/participants/remove', [$tournament->id, $participant->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este participante?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" title="Eliminar">🗑️</button>
              </form>
            </div>
          @endif
        </div>
      @endforeach


    </div>
  @else
    <p>No hay participantes registrados aún.</p>
  @endif
</div>


</div>


@endsection