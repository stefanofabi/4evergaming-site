      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMultiTheftAuto" aria-labelledby="offcanvasMultiTheftAuto">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title"> MTA San Andreas
            <button class="btn btn-secondary ms-3" onclick="loadGame('mta')"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
              </svg> 
            </button>
          </h5>
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
              @foreach ([1,2,3,4,5] as $value)
              <tr>
                <td style="font-size: 12px" id="mta-name-{{ $value }}"></td>
                <td style="font-size: 12px" id="mta-players-{{ $value }}"></td>
                <td style="font-size: 12px" id="mta-map-{{ $value }}"></td>
                <td style="font-size: 12px" id="mta-joinlink-{{ $value }}"></td>
              @endforeach
              </tr>
            </tbody>
          </table>

          <p class="text-center" id="endMessage"> Estas buscando Hosting? Visitá nuestra <a href="https://clientes.4evergaming.com.ar/store/grand-theft-auto/multi-theft-auto-mta?currency=2">lista de precios </a> </p>
        </div>
      </div>