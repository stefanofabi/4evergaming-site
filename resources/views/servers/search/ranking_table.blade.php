<div class="fs-3 mt-5">
    ⚔️ Listado de servidores
</div>
<div class="table-responsive">
    <table class="table table-light table-striped table-hover mt-4">
        <thead>
            <tr>
                <th scope="col" style="text-align: center"> Rank </th>
                <th scope="col"> Nombre </th>
                <th scope="col" style="text-align: center"> IP </th>
                <th scope="col" style="text-align: center"> Jugadores </th>
                <th scope="col" style="text-align: center"> Pais </th>
                <th scope="col" style="text-align: center"> Mapa </th>
                <th class="text-end" scope="col"> Acciones </th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($servers as $server)
            <tr>
                <td class="text-center"> <span class="badge text-bg-dark"> {{ $server->rank }} </span>  </td>
                
                <td> 
                    <a class="text-decoration-none text-dark ms-2 text-nowrap" href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" title="{{ $server->hostname }}"> {{ substr($server->hostname, 0, 80) }} </a> 
                    @if (! $server->status) <span class="badge badge-danger"> OFFLINE </span> @endif
                </td>
                    
                <td class="text-center"> {{ $server->server_address }} </td>
                <td class="text-center"> {{ $server->num_players .'/'. $server->max_players }} </td>
                <td class="text-center"> <img src="{{ asset('images/country-flags/'.$server->country->flag) }}" title="{{ $server->country->name }}" alt="{{ $server->country->name }}"> </td>
                <td class="text-center"> {{ $server->map }} </td>
                <td class="text-end"> 
                    <a class="text-decoration-none text-dark ms-2" href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" title="Ver información {{ $server->server_address }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </a>

                    <a class="text-decoration-none text-dark ms-2" href="{{ $server->join_link }}" title="Conectarse a {{ $server->server_address }}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam" viewBox="0 0 16 16">
                            <path d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z"/>
                            <path d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z"/>
                        </svg> 
                    </a> 
                </td>
            </tr>
            @empty
            <tr> <td class="text-danger" colspan="7"> No encontramos servidores </td> </tr>
            @endforelse
        </tbody>
    </table>
</div>