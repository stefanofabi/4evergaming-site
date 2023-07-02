<div class="d-flex">
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow rounded-3 w-100 mt-3 ms-4 me-4">
    
        <a class="navbar-brand" href=""> <img class="ms-3" src="{{ asset('images/games-icons/'.$game->large_logo) }}" heigth="120" width="200" title="Servidores de {{ $game->name }}" alt="Logo {{ $game->name }}"> </a>

        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-2" id="collapsibleNavbar">
            <form class="w-100" action="{{ route('servers/search', ['game' => $game->protocol]) }}">
                <div class="d-inline-flex p-2 w-100">
                    
                    <input class="form-control" type="text" name="filter" value="{{ old('filter') ?? $filter ?? '' }}" placeholder="Ingresá nombre o IP para filtrar" aria-label="default input example">
                        
                    <button type="submit" class="btn btn-danger ms-3"> Buscar </button>
                </div>     
            </form>
            
            <div class="d-flex justify-content-md-end w-100 me-3">
                @if (auth()->user())
                    @if (is_null(auth()->user()->community))
                    <button type="button" class="btn btn-outline-dark d-none d-md-block" data-bs-toggle="modal" data-bs-target="#addCommunityModal"> ➕ Agregar Comunidad </button>
                    @else 
                    <button type="button" class="btn btn-outline-dark d-none d-md-block" data-bs-toggle="modal" data-bs-target="#addServerModal"> ➕ Agregar Servidor </button>
                    @endif
                @else
                <a class="btn btn-outline-dark ms-5 d-none d-md-block" href="{{ route('login') }}"> Iniciar sesión con Steam </a>
                @endif
            </div>

            <ul class="navbar-nav d-md-none">
                @guest
                <li class="nav-item">
                    <a class="nav-link text-center" aria-current="page" href="{{ route('login') }}"> Iniciar sesión con Steam </a>
                </li>
                @endguest

                @auth
                    @if (is_null(auth()->user()->community))
                    <li class="nav-item">
                        <a class="nav-link text-center" aria-current="page" data-bs-toggle="modal" data-bs-target="#addCommunityModal"> Agregar Comunidad </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-center" aria-current="page" data-bs-toggle="modal" data-bs-target="#addServerModal"> Agregar Servidor </a>
                    </li>
                    @endif
                @endauth
            </ul>
        </div>
    </nav>
</div>