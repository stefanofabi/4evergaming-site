<script>
  function findServer() {
    const resultDiv = document.getElementById('servers-result');

    resultDiv.innerHTML = `
      <div class="text-center text-muted">
        Buscando servidor...
      </div>
    `;

    fetch("{{ route('servers/find') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute('content')
      },
      body: JSON.stringify({
        game_id: document.getElementById('game_id').value,
        country_id: document.getElementById('country_id').value,
        min_players: document.getElementById('min_players').value
      })
    })
    .then(res => res.json())
    .then(data => {

      if (!data.length) {
        resultDiv.innerHTML = `
          <div class="text-center text-muted">
            No se encontraron servidores
          </div>
        `;
        return;
      }

      // 🎲 servidor al azar
      const server = data[Math.floor(Math.random() * data.length)];

      const percent = Math.round(
        (server.num_players / server.max_players) * 100
      );

      const statsUrl = `{{ route('servers/info') }}?ip=${encodeURIComponent(server.ip)}&port=${server.port}`;

      resultDiv.innerHTML = `
        <div class="server-card p-4 bg-dark text-light rounded shadow-lg">

          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="server-title mb-0">${server.hostname}</h5>
            <span class="badge badge-danger badge-live">LIVE</span>
          </div>

          <div class="server-meta mb-1">
            🗺️ Mapa: <strong>${server.map}</strong>
          </div>

          <div class="server-meta mb-1">
            👥 Jugadores: <strong>${server.num_players}/${server.max_players}</strong>
          </div>

          <div class="players-bar mb-3" style="height: 8px; background: #333; border-radius:4px;">
            <div class="players-bar-fill" style="width:${Math.round((server.num_players / server.max_players) * 100)}%; background: #dc3545; height:100%; border-radius:4px;"></div>
          </div>

          <div class="server-meta mb-3">
            🌐 ${server.ip}:${server.port}
          </div>

          <div class="d-flex gap-2">
            <a href="${server.join_link}"
              class="btn btn-danger flex-fill text-white">
              🎮 Conectarse
            </a>

            <a href="${statsUrl}"
              target="_blank"
              class="btn btn-outline-danger flex-fill">
              📊 Ver estadísticas
            </a>
          </div>

        </div>
        `;


    })
    .catch(err => {
      console.error(err);
      resultDiv.innerHTML = `
        <div class="text-danger text-center">
          Error al buscar servidor
        </div>
      `;
    });
  }
</script>

<style>
  .server-card {
    background: linear-gradient(145deg, #0b0b0b, #151515);
    border: 1px solid #dc3545;
    border-radius: 12px;
    box-shadow:
      0 0 15px rgba(220, 53, 69, 0.35),
      inset 0 0 20px rgba(0, 0, 0, 0.8);
    animation: pulseGlow 2.5s infinite;
  }

  @keyframes pulseGlow {
    0% { box-shadow: 0 0 12px rgba(220,53,69,.3); }
    50% { box-shadow: 0 0 25px rgba(220,53,69,.6); }
    100% { box-shadow: 0 0 12px rgba(220,53,69,.3); }
  }

  .server-title {
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #ff3b3b;
  }

  .server-meta {
    font-size: 0.9rem;
    color: #bbb;
  }

  .players-bar {
    height: 8px;
    background: #222;
    border-radius: 5px;
    overflow: hidden;
    margin: 6px 0 12px;
  }

  .players-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #dc3545, #ff5f5f);
    box-shadow: 0 0 8px rgba(220,53,69,.8);
  }

  .join-btn {
    background: linear-gradient(90deg, #dc3545, #b02a37);
    border: none;
    font-weight: bold;
    letter-spacing: .5px;
    transition: all .2s ease;
  }

  .join-btn:hover {
    transform: scale(1.03);
    box-shadow: 0 0 15px rgba(220,53,69,.8);
  }

  .badge-live {
    background: #dc3545;
    font-size: 0.65rem;
    padding: 4px 8px;
    border-radius: 20px;
    animation: blink 1.5s infinite;
  }

  @keyframes blink {
    0%,100% { opacity: 1; }
    50% { opacity: .5; }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg border-bottom border-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-danger fw-bold" href="{{ route('servers/index') }}">
      <img src="{{ asset('images/logo/transparent-official-logo.png') }}" alt="Logo" width="80" height="60" class="d-inline-block align-text-top me-2">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#gameMenu" aria-controls="gameMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="gameMenu">
      <ul class="navbar-nav me-auto align-items-center">
        <li class="nav-item me-3">
          <a class="nav-link text-danger" href="{{ route('servers/index') }}">Inicio</a>
        </li>
        
        @php
          $games = \App\Models\Game::whereHas('servers')->get();
        @endphp

        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle text-danger" href="#" role="button" data-bs-toggle="dropdown">
            Servidores
          </a>

          <ul class="dropdown-menu dropdown-menu-dark">
            @foreach ($games as $game)
              <li>
                <a class="dropdown-item" href="{{ route('servers/search', ['game' => $game->protocol]) }}"> {{ $game->name }} </a>
              </li>
            @endforeach
          </ul>
        </li>
        
        <li class="nav-item me-3">
          <a class="nav-link text-danger" href="{{ route('communities/index') }}">Comunidades</a>
        </li>

        <li class="nav-item"><a class="nav-link text-danger" href="{{ route('tournaments/index') }}">Torneos</a></li>
      </ul>

      <!-- Botones a la derecha -->
      <ul class="navbar-nav ms-auto align-items-center">
        @auth
        <li class="nav-item me-2">
          <a class="btn btn-outline-danger" href="#" data-bs-toggle="modal" data-bs-target="#findServer">Buscar servidor</a>
        </li>

        <li class="nav-item">
          <a class="btn btn-danger" href="{{ route('profile', ['steam_id' => auth()->user()->steam_id]) }}">Mi perfil</a>
        </li>
        @endauth
        
        @guest
        <li class="nav-item">
          <a class="btn btn-danger" href="{{ route('login') }}">Iniciar sesión</a>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>


<div class="modal fade" id="findServer" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark text-light">

      <div class="modal-header">
        <h5 class="modal-title">Buscar servidor</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Juego</label>

            @php
              $games = \App\Models\Game::whereHas('servers')->get();
            @endphp
            
            <select id="game_id" class="form-select">
              @foreach ($games as $game)
                <option value="{{ $game->id }}">{{ $game->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">País</label>

            @php
              $games = \App\Models\Country::orderBy('name', 'ASC')->get();
            @endphp

            <select id="country_id" class="form-select">
              @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Jugadores mínimos</label>
            <input type="number" id="min_players" class="form-control" value="4">
          </div>
        </div>

        <hr>

        <div id="servers-result" class="mt-3">
          <div class="text-center text-muted">
            Usá los filtros y presioná buscar
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button class="btn btn-danger" onclick="findServer()">Buscar</button>
      </div>

    </div>
  </div>
</div>
