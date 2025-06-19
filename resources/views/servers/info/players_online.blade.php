<div class="card mt-3 p-3 h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%) !important;">
    <h3> ➡️ Jugadores en línea </h3>

    <div class="table-responsive mt-3">
        <table class="table-hover text-light w-100" style="background: transparent !important;">
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
                    <td> {{ $player['gq_name'] }} </td>
                    <td class="text-center"> {{ $player['gq_score'] }} </td>
   
                    @php
                        $seconds = $player['gq_time'] ?? null;

                        if (is_null($seconds)) {
                            $humanReadable = 'No time';
                        } else {
                            $days = floor($seconds / 86400);
                            $remainder = $seconds % 86400;

                            $minutes = floor($remainder / 60);
                            $secs = $remainder % 60;

                            $parts = [];

                            if ($days > 0) {
                                $parts[] = $days . 'd';
                            }

                            if ($minutes > 0) {
                                $parts[] = $minutes . 'm';
                            }

                            // Solo mostrar segundos si no hay días ni minutos, o si segundos > 0
                            if (($days == 0 && $minutes == 0) || $secs > 0) {
                                $parts[] = $secs . 's';
                            }

                            $humanReadable = implode(' ', $parts);
                        }
                    @endphp

                    <td class="text-center">{{ $humanReadable }}</td>

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
