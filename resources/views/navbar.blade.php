<nav class="navbar navbar-dark navbar-expand-lg bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img loading="lazy" src="{{ asset('images/logo/transparent-official-logo.png') }}" alt="Logo 4evergaming" width="80" height="60" title="The 4evergaming Logo">
        </a>
    
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Counter-Strike Hosting
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('games/counter-strike') }}">Counter-Strike 1.6</a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/counter-strike-source?currency=2" target="_blank">Counter-Strike: Source</a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/counter-strike-source?currency=2" target="_blank">Counter-Strike: Source Offensive</a></li>
                        <li><a class="dropdown-item" href="{{ route('games/counter-strike-global-offensive') }}">Counter-Strike: Global Offensive</a></li>
                        <li><a class="dropdown-item" href="{{ route('games/counter-strike-2') }}">Counter-Strike 2</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Grand Theft Auto Hosting
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/grand-theft-auto/san-andreas-multi-player-samp?currency=2" target="_blank">San Andreas Multi Player</a></li>
                        <li><a class="dropdown-item" href="{{ route('games/multi-theft-auto') }}"> Multi Theft Auto </a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/grand-theft-auto/ragemp?currency=2" target="_blank">RageMP</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Minecraft Hosting
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/minecraft/minecraft-java?currency=2" target="_blank">Minecraft Java Edition</a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/minecraft/minecraft-bedrock?currency=2" target="_blank">Minecraft Bedrock</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vps-hosting') }}">VPS Hosting</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank">Web Hosting</a>
                </li>
                
                <!--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hosting Revendedores
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/hosting-revendedores/reseller-pack-hlds-3005001000fps?currency=2" target="_blank">Reseller Pack HLDS</a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/hosting-revendedores/reseller-pack-srcds-64100128-tick?currency=2" target="_blank">Reseller Pack SRCDS</a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/hosting-revendedores/reseller-pack-gta?currency=2" target="_blank">Reseller Pack GTA</a></li>
                    </ul>
                </li>
                -->

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Más...
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/half-life?currency=2" target="_blank">Half-Life</a></li>
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/half-life-2?currency=2" target="_blank"> Half-Life 2 </a></li> -->
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/call-of-duty?currency=2" target="_blank">Call Of Duty</a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/battlefield?currency=2" target="_blank"> Battlefield </a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/left-4-dead?currency=2" target="_blank"> Left 4 Dead </a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/team-fortress?currency=2" target="_blank">Team Fortress</a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/killing-floor?currency=2" target="_blank"> Killing Floor </a></li>
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/medal-of-honor?currency=2" target="_blank"> Medal Of Honor </a></li>
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/day-of-defeat?currency=2" target="_blank">Day of Defeat</a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/carreras-and-competicion?currency=2" target="_blank">Carreras & Competicion</a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/servidores-de-futbol?currency=2" target="_blank">Futbol</a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/simuladores?currency=2" target="_blank"> Simuladores </a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/servidores-de-zombies-and-vampiros?currency=2" target="_blank">Zombies & Vampiros</a></li> -->
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/servidores-de-dragon-ball-z?currency=2" target="_blank">Dragon Ball Z</a></li>
                        <!--<li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/shooters?currency=2" target="_blank">Shooters</a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/shooter-terror-games?currency=2" target="_blank">Shooters Terror Game</a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/sandbox-y-supervivencia?currency=2" target="_blank">Sandbox & Supervivencia</a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/mmorpg?currency=2" target="_blank">MMORPG</a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/game-hosting-reseller?currency=2" target="_blank"> Game Hosting Reseller </a></li> -->
                        <!-- <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store/cpanel-hosting-reseller?currency=2" target="_blank"> cPanel Hosting Reseller </a></li> -->
                        <li><a class="dropdown-item" href="https://clientes.4evergaming.com.ar/store?currency=2" target="_blank"> Ver todos </a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="float-end">
            <a href="{{ route('server-status') }}" class="text-decoration-none text-success me-3" id="statusServer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                </svg>
            
                <span id="ping-gameservers"> Verificando estado de los servicios...  <div class="spinner-border spinner-border-sm" role="status"></div></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>