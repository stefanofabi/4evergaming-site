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

<script type="module">
  $("#editTournamentForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('tournaments/update', ['tournament' => $tournament->id]) }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#saveTournamentDataButton').addClass("disabled");
                $('#editTournamentForm').css("opacity",".5");
                $('#responseTournamentData').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseTournamentData').html('<span style="font-size:18px;color:#34A853"> Torneo '+ response.name +' actualizado exitosamente </span>');
            $('#editTournamentForm').css("opacity","");
            $("#saveTournamentDataButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseTournamentData').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#editTournamentForm').css("opacity","");
            $("#saveTournamentDataButton").removeClass("disabled");
          });
  });

  $("#editTournamentBannerForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('tournaments/update-banner', ['tournament' => $tournament->id]) }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#saveTournamentBannerButton').addClass("disabled");
                $('#editTournamentBannerForm').css("opacity",".5");
                $('#responseTournamentBanner').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseTournamentBanner').html('<span style="font-size:18px;color:#34A853"> Torneo '+ response.name +' actualizado exitosamente </span>');
            $('#editTournamentBannerForm').css("opacity","");
            $("#saveTournamentBannerButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseTournamentBanner').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#editTournamentBannerForm').css("opacity","");
            $("#saveTournamentBannerButton").removeClass("disabled");
          });
  });
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
<div class="tournament-card mb-4 rounded shadow-sm" style="background-color: #1c1c1c; color: #f8f9fa;">
  <div class="row g-0 p-3">
    
    @if($tournament->tournament_image)
      <div class="col-md-4 mb-3 mb-md-0">
        <a href="{{ $tournament->event_url }}" target="_blank"> <img src="{{ asset('storage/tournaments/' . $tournament->tournament_image) }}" 
             alt="Imagen de {{ $tournament->name }}" 
             class="img-fluid rounded"> </a>
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
          @if (auth()->user() && ($tournament->organizer_id == auth()->user()->id || auth()->user()->steam_id == "7656119825950279"))
            <button type="button" class="gamer-signup-btn bg-dark border border-light text-decoration-none" data-bs-toggle="modal" data-bs-target="#editTournamentModal">
              ✏️ Editar Torneo
            </button>

            <button type="button" class="gamer-signup-btn bg-dark border border-light text-decoration-none" data-bs-toggle="modal" data-bs-target="#editBannerModal">
              ✏️ Editar Banner
            </button>
          @else 
            @if($tournament->event_url)
              <a href="{{ $tournament->event_url }}" 
                class="gamer-signup-btn text-decoration-none" 
                target="_blank">
                🎫 Ver Evento
              </a>
            @endif

            @if($tournament->status === 'upcoming')
              @if($isRegistered)
                <button type="button" class="gamer-signup-btn" disabled>
                  ✅ Ya estás inscripto
                </button>
              @else
                <form id="register-form" 
                      action="{{ route('tournaments/register', ['tournament' => $tournament->id]) }}" 
                      method="POST" 
                      onsubmit="return confirmRegistration()">
                  @csrf
                  <button type="submit" class="gamer-signup-btn">
                    🔥 Inscribirme!
                  </button>
                </form>
              @endif
            @endif
          @endif
        </div>
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
        <div style="width: 50px;" class="text-start">&nbsp #</div>
        <div class="flex-grow-1">
          @if ($tournament->type === 'team')
            Equipo
          @elseif ($tournament->type === 'community')
            Comunidad
          @else
            Jugador
          @endif
        </div>
        <div style="width: 80px" class="text-center">Puntos</div>
        @if (auth()->user() && ($tournament->organizer_id == auth()->user()->id || auth()->user()->steam_id == "76561198259502796"))
          <div style="width: 150px;" class="text-center">Acciones</div>
        @endif
      </div>

      @php $position = 1; @endphp

      @foreach($tournament->participants->sortByDesc('points') as $participant)
        <div class="participant-item d-flex mb-1 align-items-center">
          <div style="width: 50px;" class="text-start">{{ $position++ }}</div>

          {{-- 👤 Jugador / 🛡️ Equipo / 🏠 Comunidad --}}
          <div class="flex-grow-1 d-flex align-items-center">

          @php
              $name = '';
              $avatar = null;
              $link = null;

              if ($tournament->type === 'team' && $participant->user->team) {
                  $team = $participant->user->team;
                  $name = $team->name;
                  $avatar = $team->logo ? asset('storage/teams/logos/' . $team->logo) : null;
                  $link = route('teams/show', $team->slug ?? $team->id);
              } elseif ($tournament->type === 'community' && $participant->user->community) {
                  $community = $participant->user->community;
                  $name = $community->name;
                  $avatar = $community->logo ? asset('storage/communities/' . $community->logo) : null;
                  $link = route('communities/show', ['slug' => $community->slug]);
              } else {
                  $name = $participant->user->name;
                  $avatar = $participant->user->avatar;
                  $link = $participant->user->profile_url;
              }
          @endphp

            {{-- Mostrar avatar con enlace si existe --}}
            @if($avatar)
              @if($link)
                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" style="display: inline-block; margin-right: 10px;">
                  <img src="{{ $avatar }}" alt="Avatar de {{ $name }}" 
                      style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                </a>
              @else
                <img src="{{ $avatar }}" alt="Avatar de {{ $name }}" 
                    style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
              @endif
            @endif

            {{ $name }}
          </div>

          {{-- Puntos --}}
          <div style="width: 80px;" class="text-center">{{ $participant->points }}</div>

          {{-- Acciones para admins u organizador --}}
          @if (auth()->user() && ($tournament->organizer_id == auth()->user()->id || auth()->user()->steam_id == "76561198259502796"))
            <div style="width: 150px;" class="text-center d-flex justify-content-center gap-2">
              {{-- Sumar punto --}}
              <form action="{{ route('tournaments/participants/increment', ['tournament' => $tournament->id, 'participant' => $participant->id]) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-success btn-sm" title="Sumar punto">+</button>
              </form>

              {{-- Restar punto --}}
              <form action="{{ route('tournaments/participants/decrement', ['tournament' => $tournament->id, 'participant' => $participant->id]) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-warning btn-sm" title="Restar punto">−</button>
              </form>

              {{-- Eliminar --}}
              <form action="{{ route('tournaments/participants/remove', ['tournament' => $tournament->id, 'participant' => $participant->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este participante?');">
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

<!-- Modal: Editar Torneo -->
<div class="modal fade" id="editTournamentModal" tabindex="-1" aria-labelledby="editTournamentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="editTournamentForm" action="" method="POST">
      @csrf
      @method('PUT')

      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="editTournamentModalLabel">✏️ Editar Torneo</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $tournament->name }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="4">{{ $tournament->description }}</textarea>
          </div>

          <div class="mb-3 row">
            <div class="col-md-6">
              <label class="form-label">Fecha de inicio</label>
              <input type="date" name="start_date" class="form-control" value="{{ $tournament->start_date }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha de finalización</label>
              <input type="date" name="end_date" class="form-control" value="{{ $tournament->end_date }}">
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-6">
              <label class="form-label">Máx. Participantes</label>
              <input type="number" name="max_participants" class="form-control" value="{{ $tournament->max_participants }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Participantes por equipo</label>
              <input type="number" name="max_participants_per_team" class="form-control" value="{{ $tournament->max_participants_per_team }}">
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-6">
              <label class="form-label">Ubicación</label>
              <input type="text" name="location" class="form-control" value="{{ $tournament->location }}">
            </div>

            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select name="status" class="form-select">
                <option value="upcoming" {{ $tournament->status == 'upcoming' ? 'selected' : '' }}>Próximo</option>
                <option value="ongoing" {{ $tournament->status == 'ongoing' ? 'selected' : '' }}>En curso</option>
                <option value="completed" {{ $tournament->status == 'completed' ? 'selected' : '' }}>Finalizado</option>
                <option value="cancelled" {{ $tournament->status == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
              </select>
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-6">
              <label class="form-label">Premio</label>
              <input type="text" name="prize" class="form-control" value="{{ $tournament->prize }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Cuota de inscripción</label>
              <input type="number" step="0.01" name="entry_fee" class="form-control" value="{{ $tournament->entry_fee }}">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">URL del evento</label>
            <input type="url" name="event_url" class="form-control" value="{{ $tournament->event_url }}">
          </div>

        </div>

        <div class="modal-footer">
          <div id="responseTournamentData"></div>

          <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger" id="saveTournamentDataButton">💾 Guardar Cambios</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal: Editar Banner -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editTournamentBannerForm" action="" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="editBannerModalLabel">🖼️ Editar Banner</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Seleccionar nueva imagen</label>
            <input type="file" name="tournament_image" class="form-control" accept="image/*" required>
          </div>

          @if($tournament->tournament_image)
            <div class="mb-3">
              <label class="form-label">Imagen actual:</label><br>
              <img src="{{ asset('storage/tournaments/' . $tournament->tournament_image) }}" alt="Imagen actual" style="max-width: 100%; border: 1px solid #fff;">
            </div>
          @endif

        </div>

        <div class="modal-footer">
          <div id="responseTournamentBanner"></div>

          <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger" id="saveTournamentBannerButton">💾 Guardar Banner</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection