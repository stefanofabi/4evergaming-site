<div class="fs-3 mt-5 text-light">
    ⚔️ Listado de servidores
</div>

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover mt-4 align-middle">
        <thead>
            <tr>
                <th scope="col" class="text-center">Rank</th>
                <th scope="col">Nombre</th>
                <th scope="col" class="text-center">IP</th>
                <th scope="col" class="text-center">Jugadores</th>
                <th scope="col" class="text-center">País</th>
                <th scope="col" class="text-center">Mapa</th>
                <th scope="col" class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($servers as $server)
            <tr>
                <td class="text-center">
                    <span class="badge bg-secondary text-light">{{ $server->rank }}</span>
                </td>

                <td>
                    <img src="{{ asset('images/games-icons/' . $server->game->logo) }}" alt="{{ $server->game->name }} Logo" 
                        width="24" height="24" class="me-2 align-middle" style="border-radius: 4px;">
                  

                    <a href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" 
                    title="{{ $server->hostname }}" 
                    class="text-decoration-none text-warning fw-semibold">
                        {{ substr($server->hostname, 0, 80) }}
                    </a>

                    @if (! $server->status) 
                        <span class="badge bg-danger ms-2">OFFLINE</span> 
                    @endif
                </td>

<td class="text-center text-light"
    style="cursor: pointer;"
    data-bs-toggle="tooltip"
    data-bs-placement="top"
    title="Copiado"
    onclick="copyToClipboard(this)">
    {{ $server->server_address }}
</td>

                
                <td class="text-center text-light">{{ $server->num_players . '/' . $server->max_players }}</td>
                <td class="text-center">
                    <img src="{{ asset('images/country-flags/' . $server->country->flag) }}" 
                         title="{{ $server->country->name }}" 
                         alt="{{ $server->country->name }}" 
                         style="height: 22px; border-radius: 3px;">
                </td>
                <td class="text-center text-light">{{ $server->map }}</td>
                
                <td class="text-end">
                    <a href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" 
                    title="Ver información {{ $server->server_address }}" 
                    class="text-white me-3 action-icon text-decoration-none">
                        <!-- Ícono info -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </a>

                    <a href="{{ $server->join_link }}" 
                    title="Conectarse a {{ $server->server_address }}" 
                    class="text-white action-icon">
                        <!-- Ícono steam -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-steam" viewBox="0 0 16 16">
                            <path d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z"/>
                            <path d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z"/>
                        </svg>
                    </a>
                </td>


            </tr>
            @empty
            <tr>
                <td class="text-danger text-center" colspan="7">No encontramos servidores</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
