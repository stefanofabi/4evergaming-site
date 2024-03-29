        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
              <a type="button" class="text-decoration-none text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMultiTheftAuto" aria-controls="offcanvasMultiTheftAuto" onclick="loadGame('mta')">
                <img loading="lazy" src="{{ asset('images/games-icons/multi-theft-auto.ico') }}" alt="Logo de Multi Theft Auto" width="20" height="20" title="The Multi Theft Auto Logo"> 
                MTA San Andreas
              </a>
            </div>
            Libertad y caos en el mundo abierto: aventura urbana
          </div>
          <button class="badge bg-danger rounded-pill border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMultiTheftAuto" aria-controls="offcanvasMultiTheftAuto" onclick="loadGame('mta')"> Ver servidores </button>
        </li>

        @include('pages/home/offcanvas/multi-theft-auto')