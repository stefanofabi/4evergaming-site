<div class="table-responsive">
    <table class="table table-light table-striped table-hover mt-4">
        <thead>
            <tr>
                <th scope="col"> Rank </th>
                <th scope="col"> Nombre </th>
                <th scope="col"> Capacidad </th>
                <th scope="col"> Pais </th>
                <th scope="col"> IP </th>
                <th scope="col"> Mapa </th>
                <th class="text-end" scope="col"> Acciones </th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($servers as $server)
            <tr>
                <td> <span class="badge text-bg-dark"> {{ $server->rank }} </span>  </td>
                <td> <a class="text-decoration-none text-dark ms-2" href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}"> {{ $server->hostname }} </a> </td>
                <td> {{ $server->users_online .'/'. $server->max_players }} </td>
                <td> {{ $server->country->name }} </td>
                <td> {{ $server->server_address }} </td>
                <td> {{ $server->map }} </td>
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