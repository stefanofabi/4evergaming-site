<div class="container mt-3">
    <div class="card p-3">
        <h3> ➡️ Jugadores en línea </h3>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"> Nombre </th>
                        <th class="text-center" scope="col"> Score </th>
                        <th class="text-center" scope="col"> Tiempo jugado </th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse (collect($server->players)->sortByDesc('gq_score') as $player)
                    <tr>
                        <td> {{ $player['name'] }} </td>
                        <td class="text-center"> {{ $player['gq_score'] }} </td>
                        <td class="text-center"> {{ $player['gq_time_human'] }} </td>
                    </tr>
                    @empty
                        @if ($server->num_players > 0)
                        <tr> <td class="text-danger" colspan="4"> No pudimos obtener los jugadores conectados </td> </tr>
                        @else 
                        <tr> <td class="text-danger" colspan="4"> No hay jugadores conectados 😔 </td> </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>