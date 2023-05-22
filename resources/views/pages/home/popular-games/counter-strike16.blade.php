        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
              <a type="button" class="text-decoration-none text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCounterStrike16" aria-controls="offcanvasCounterStrike16" onclick="loadGame('cs16')">
                <img loading="lazy" src="{{ asset('images/games-icons/counter-strike16.ico') }}" alt="Logo de Counter-Strike 1.6" width="20" height="20" title="The Counter Strike Logo"> 
                Counter-Strike 1.6 
              </a> 
            </div>
            FPS táctico multijugador: acción intensa y estratégica
          </div>
          <button class="badge bg-danger rounded-pill border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCounterStrike16" aria-controls="offcanvasCounterStrike16" onclick="loadGame('cs16')"> Ver servidores </button>
        </li>

        @include('pages/home/offcanvas/counter-strike16')