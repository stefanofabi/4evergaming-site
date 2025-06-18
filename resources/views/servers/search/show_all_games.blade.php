<div class="d-flex justify-content-center mt-4">
    <a class="text-decoration-none text-light fs-5" data-bs-toggle="collapse" href="#gamesCollapse" role="button" aria-expanded="false" aria-controls="gamesCollapse">
        Ver todos los juegos ⬇️
    </a>
</div>

<div class="d-flex justify-content-center mt-3">
    <div class="collapse text-center" id="gamesCollapse">
        @foreach ($games as $game_aux)
        <a type="button" class="btn btn-outline-danger m-1" href="{{ route('servers/search', ['game' => $game_aux->protocol]) }}">
            <img loading="lazy" src="{{ asset('images/games-icons/'.$game_aux->logo) }}" alt="Logo de {{ $game_aux->name }}" width="30" height="30" title="{{ $game_aux->name }}">
            {{ $game_aux->name }} 
        </a>
        @endforeach
    </div>
</div>