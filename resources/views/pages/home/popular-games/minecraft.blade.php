        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
            <a type="button" class="text-decoration-none text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMinecraft" aria-controls="offcanvasMinecraft" onclick="loadGame('minecraft')">
            <img loading="lazy" src="{{ asset('images/games-icons/minecraft.ico') }}" alt="Logo de Minecraft" width="20" height="20" title="The Minecraft Logo"> Minecraft
              </a>
              
            </div>
            No basta con tener un buen pico, lo principal es usarlo bien.
          </div>
          <span class="badge bg-danger rounded-pill"> +{{ $total_minecraft_servers }} </span>
        </li>

        @include('pages/home/offcanvas/minecraft')