        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
              <a type="button" class="text-decoration-none text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCounterStrikeGlobalOffensive" aria-controls="offcanvasCounterStrikeGlobalOffensive" onclick="loadGame('csgo')">
                <img loading="lazy" src="{{ asset('images/games-icons/counter-strike-global-offensive.ico') }}" alt="Logo de Counter-Strike 1.6" width="20" height="20" title="The Counter Strike: Global Offensive Logo"> 
                Counter-Strike: GO
              </a> 
            </div>
            Combate táctico en equipos: Dispará, planificá y dominá
          </div>
          <button class="badge bg-danger rounded-pill border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCounterStrikeGlobalOffensive" aria-controls="offcanvasCounterStrikeGlobalOffensive" onclick="loadGame('csgo')"> Ver servidores </button>
        </li>

        @include('pages/home/offcanvas/counter-strike-global-offensive')