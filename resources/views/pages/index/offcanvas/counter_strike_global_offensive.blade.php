      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCounterStrikeGlobalOffensive" aria-labelledby="offcanvasCounterStrikeGlobalOffensiveLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title"> Counter-Strike: Global Offensive</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body">
          <p> Gracias por seguir confiando en 4evergaming. Te presentamos el Top 5 para que disfrutes al máximo: </p>
          <table class="table">
            <thead>
              <tr>
                <th class="text-left" scope="col"> Comunidad </th>
                <th class="text-center" scope="col"> Jugadores</th>
                <th class="text-center" scope="col"> Mapa</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ([1,2,3,4,5] as $value)
              <tr>
                <td style="font-size: 12px" id="csgo-name-{{ $value }}"></td>
                <td style="font-size: 12px" id="csgo-players-{{ $value }}"></td>
                <td style="font-size: 12px" id="csgo-map-{{ $value }}"></td>
                <td style="font-size: 12px" id="csgo-steam-{{ $value }}"></td>
              @endforeach
              </tr>
            </tbody>
          </table>

          <p class="text-center" id="endMessage"> Estas buscando mas servidores? Visitá <a href="https://cincoya.net"> cincoya.net </a> </p>
        </div>
      </div>