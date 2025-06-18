    <!-- Título principal -->
    <div class="text-center mb-5">
        <h1 class="display-5 text-danger fw-bold">Explorá Servidores y Comunidades de Juegos</h1>
        <p class="text-light">Buscá servidores activos, descubrí comunidades y unite a partidas épicas.</p>
    </div>

    <!-- Buscador -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="/buscar-servidores" method="GET" class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Buscar servidor, IP o comunidad...">
                <button class="btn btn-danger" type="submit">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Botones dinámicos de gameTags debajo del buscador -->
    <div class="text-center mb-5">
        <div class="d-flex flex-wrap justify-content-center gap-3">

            @foreach ($game->gameTags as $gameTag)
                <a href="{{ route('servers/search', ['game' => $game->protocol, 'game_tag' => $gameTag->name]) }}" 
                class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm transition">
                    {{ $gameTag->name }}
                </a>
            @endforeach

        </div>
    </div>
