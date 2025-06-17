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
        
        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle text-danger" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Servidores
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'hl1']) }}">Half Life</a></li>
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'cs16']) }}">Counter-Strike 1.6</a></li>
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'css']) }}">Counter-Strike: Source</a></li>
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'mta']) }}">Multi Theft Auto</a></li>
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'cod2']) }}">Call Of Duty 2</a></li>
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'cod4']) }}">Call Of Duty 4</a></li>
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'mohaa']) }}">Medal Of Honor: Allied Assault</a></li>
            <li><a class="dropdown-item" href="{{ route('servers/search', ['game' => 'bf2']) }}">Battle Field 2</a></li>
          </ul>
        </li>
        
        <li class="nav-item me-3">
          <a class="nav-link text-danger" href="{{ route('communities/index') }}">Comunidades</a>
        </li>
        

        <li class="nav-item"><a class="nav-link text-danger disabled" href="/torneos">Torneos</a></li>
      </ul>

      <!-- Botones a la derecha -->
      <ul class="navbar-nav ms-auto align-items-center">
        @auth
        <li class="nav-item me-2">
          <a class="btn btn-outline-danger" href="#">Buscar competitivo</a>
        </li>

        <li class="nav-item">
          <a class="btn btn-danger" href="#">Mi perfil</a>
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
