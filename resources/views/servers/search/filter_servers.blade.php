    <!-- Título principal -->
    <div class="text-center mb-5">
        <h1 class="display-5 text-danger fw-bold">Explorá Servidores y Comunidades de Juegos</h1>
        <p class="text-light">Buscá servidores activos, descubrí comunidades y unite a partidas épicas.</p>
    </div>

    <!-- Buscador -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="{{ route('servers/search', ['game' => $game->protocol ?? '']) }}" method="GET" class="input-group">
               <input type="text" name="filter" class="form-control form-control-lg" placeholder="Buscar servidor, IP o comunidad..." value="{{ $filter ?? '' }}">
                <input type="hidden" name="game_tag" value="{{ $game_tag->name ?? '' }}">

                <button class="btn btn-danger btn-lg" type="submit">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Botones dinámicos de gameTags debajo del buscador -->
    @if ($game)
    <div class="text-center mb-5 ps-3 pe-3">
        <div class="d-flex flex-wrap justify-content-center gap-3 align-items-center">
            @foreach ($game->gameTags as $gameTag)
                <a href="{{ route('servers/search', ['game' => $game->protocol, 'game_tag' => $gameTag->name, 'filter' => $filter ?? '']) }}" 
                class="btn {{ isset($game_tag) && $gameTag->id === $game_tag->id ? 'btn-danger' : 'btn-outline-light' }} rounded-pill px-4 py-2 fw-semibold shadow-sm transition">
                    {{ $gameTag->name }}
                </a>
            @endforeach

            @if (isset($game_tag))
            <!-- Icono cruz para deseleccionar game_tag al final solo si hay filtro -->
            <a href="{{ route('servers/search', ['game' => $game->protocol, 'filter' => $filter ?? '']) }}" 
            class="btn btn-danger rounded-circle p-0 d-flex justify-content-center align-items-center shadow-lg"
            title="Quitar filtro de game tag" 
            style="width: 36px; height: 36px; font-size: 24px; font-weight: 900; line-height: 1; transition: background-color 0.3s;">
                &times;
            </a>
            @endif
        </div>
    </div>
    @endif
