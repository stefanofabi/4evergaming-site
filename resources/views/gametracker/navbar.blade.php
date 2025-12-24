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
          use App\Models\Game;

          $games = Game::whereHas('servers')->get();
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
          <a class="btn btn-outline-danger" href="#">Buscar competitivo</a>
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
