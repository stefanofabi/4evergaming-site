        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
            <a type="button" class="text-decoration-none text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMinecraft" aria-controls="offcanvasMinecraft" onclick="loadGame('minecraft')">
              <img loading="lazy" src="{{ asset('images/games-icons/minecraft.ico') }}" alt="Logo de Minecraft" width="20" height="20" title="The Minecraft Logo"> 
              Minecraft
            </a>
              
            </div>
            Exploración y construcción en un mundo infinito: ¡Crea tu aventura!
          </div>
          <button class="badge bg-danger rounded-pill border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMinecraft" aria-controls="offcanvasMinecraft" onclick="loadGame('minecraft')"> Ver servidores </button>
        </li>

        @include('pages/home/offcanvas/minecraft')