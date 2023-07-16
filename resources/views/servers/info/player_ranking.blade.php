    <div class="card mt-3 p-3">
        <h3> ➡️ Top 10 de jugadores </h3>
        
        <div class="table-responsive">
            <table class="table table-hover">
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

                    @forelse ($server->playerRankings()->limit(10)->get()->sortByDesc('score') as $player)
                    <tr>
                        <td> #{{ $rank_player }} </td>
                        <td> {{ $player->name }} </td>
                        <td class="text-center"> {{ $player->score }} </td>
                        <td class="text-center"> {{ $player->time }} minutos </td>
                    </tr>

                    @php $rank_player++ @endphp
                    @empty
                        <tr> <td class="text-danger" colspan="3"> No hay jugadores en el ranking </td> </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
