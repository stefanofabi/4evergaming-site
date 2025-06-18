<div class="d-flex justify-content-center mt-4">
    <a class="text-decoration-none text-light fs-5" 
       data-bs-toggle="collapse" 
       href="#gamesCollapse" 
       role="button" 
       aria-expanded="false" 
       aria-controls="gamesCollapse">
        Ver todos los juegos 
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592c.859 0 1.319 1.013.753 1.658l-4.796 5.482a1 1 0 0 1-1.506 0z"/>
        </svg>
    </a>
</div>

<div class="d-flex justify-content-center mt-3 pb-3">
    <div class="collapse text-center" id="gamesCollapse">
        @foreach ($games as $game_aux)
            <a type="button" 
               class="btn {{ isset($game) && $game_aux->id === $game->id ? 'btn-danger' : 'btn-outline-danger' }} m-1" 
               href="{{ route('servers/search', ['game' => $game_aux->protocol]) }}">
                <img loading="lazy" 
                     src="{{ asset('images/games-icons/' . $game_aux->logo) }}" 
                     alt="Logo de {{ $game_aux->name }}" 
                     width="30" height="30" 
                     title="{{ $game_aux->name }}">
                {{ $game_aux->name }} 
            </a>
        @endforeach
    </div>
</div>
