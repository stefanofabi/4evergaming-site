<div class="table-responsive">
    <table class="table table-light table-striped table-hover mt-4">
        <thead>
            <tr>
                <th scope="col" style="text-align: center"> Rank </th>
                <th scope="col"> Nombre </th>
                <th scope="col" style="text-align: center"> Jugadores </th>
                <th scope="col" style="text-align: center"> Pais </th>
                <th scope="col" style="text-align: center"> IP </th>
                <th scope="col" style="text-align: center"> Mapa </th>
                <th class="text-end" scope="col"> Acciones </th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($servers as $server)
            <tr>
                <td class="text-center"> <span class="badge text-bg-dark"> {{ $server->rank }} </span>  </td>
                <td> <a class="text-decoration-none text-dark ms-2" href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}"> {{ $server->hostname }} </a> </td>
                <td class="text-center"> {{ $server->users_online .'/'. $server->max_players }} </td>
                <td class="text-center"> <img src="{{ asset('images/country-flags/'.$server->country->flag) }}" </td>
                <td class="text-center"> {{ $server->server_address }} </td>
                <td class="text-center"> {{ $server->map }} </td>
                <td class="text-end"> 
                    <a class="text-decoration-none text-dark ms-2" href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}"> Ver Info </a>
                    <a class="text-decoration-none text-dark ms-2" href="{{ $server->join_link }}"> Entrar </a> 
                </td>
            </tr>
            @empty
            <tr> <td class="text-danger" colspan="7"> No encontramos servidores </td> </tr>
            @endforelse
        </tbody>
    </table>
</div>