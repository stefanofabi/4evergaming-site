<div class="card mt-3 p-3 h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%) !important;">
    <h3> ➡️ Top jugadores </h3>
    
    <div class="table-responsive">
        <table class="table-hover text-light w-100" style="background: transparent !important;">
            <thead>
                <tr>
                    <th scope="col"> Rank </th>
                    <th scope="col"> Nombre </th>
                    <th class="text-center" scope="col"> Score </th>
                    <th class="text-center" scope="col"> Tiempo jugado </th>
                </tr>
            </thead>
            
            <tbody>
                @php $rank_player = 1 @endphp 

                @forelse ($server->playerRankings()->orderBy('score', 'desc')->limit(15)->get() as $player)
                <tr>
                    <td> #{{ $rank_player }} </td>
                    <td> {{ $player->name }} </td>
                    <td class="text-center"> {{ $player->score }} </td>
                    <td class="text-center"> {{ $player->time }} minutos </td>
                </tr>

                @php $rank_player++ @endphp
                @empty
                    <tr> <td class="text-danger" colspan="4"> No hay jugadores en el ranking </td> </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
