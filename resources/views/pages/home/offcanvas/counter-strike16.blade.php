      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCounterStrike16" aria-labelledby="offcanvasCounterStrike16Label">
        <div class="offcanvas-header">
          <h6 class="offcanvas-title"> 
            <img loading="lazy" src="{{ asset('images/games-icons/counter-strike16.ico') }}" alt="Logo de Counter-Strike 1.6" width="40" height="40" title="The Counter Strike Logo"> 
            Counter-Strike 1.6 
          </h6>
          
          <button class="btn btn-secondary btn-sm ms-3" onclick="loadGame('cs16')"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
            </svg> 
          </button>
          
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body">
          <p> Gracias por seguir confiando en 4evergaming. Te presentamos el Top 5 para que disfrutes al máximo: </p>
          <table class="table">
            <thead>
              <tr>
                <th class="text-left" scope="col"> Servidor </th>
                <th class="text-center" scope="col"> Jugadores</th>
                <th class="text-center" scope="col"> Mapa</th>
                <th class="text-end"></th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 1; $i <= count($cs_servers); $i++)
              <tr>
                <td style="font-size: 12px" id="cs16-name-{{ $i }}"></td>
                <td style="font-size: 12px" id="cs16-players-{{ $i }}"></td>
                <td style="font-size: 12px" id="cs16-map-{{ $i }}"></td>
                <td style="font-size: 12px" id="cs16-joinlink-{{ $i }}"></td>
              </tr>
              @endfor
            </tbody>
          </table>

          <p class="text-center" id="endMessage"> Estas buscando mas servidores? Visitá <a href="https://cincoya.net"> cincoya.net </a> </p>
        </div>
      </div>