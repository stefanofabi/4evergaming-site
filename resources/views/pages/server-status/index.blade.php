@extends('base')

@section('description', 'Consulta el estado de nuestros servidores de juegos en Argentina. Información actualizada sobre rendimiento y disponibilidad para múltiples títulos.')

@section('robots', 'index, follow')

@section('title')
Estado de Servidores - 4evergaming: Hosting de Juegos en Argentina
@endsection

@section('javascript')
@if (empty($node))
<script type="module">
    var labels = @json($totalOnlinePlayers->pluck('date')->toArray());
    var data = @json($totalOnlinePlayers->pluck('total_count')->toArray());

    var onlinePlayerHistoryChart = document.getElementById('onlinePlayerHistoryChart');
    var chart = new Chart(onlinePlayerHistoryChart, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cantidad de jugadores en línea',
                data: data,
                backgroundColor: '#f47363',
                borderColor: '#f47363',
                fill: true,
                tension: 0.3, 
                radius: 1
            }]
        }
    });
</script>
@endif
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 d-flex align-items-center">
        Estado de los Servidores de Juegos
    </h1>
    <p> 
        Consulta a continuación el estado de nuestros servidores en 
        <a href="https://chat.whatsapp.com/BC8FwByF4pvEZDyHC9aifM" target="_blank" class="ml-3">
            WhatsApp
        </a>
    </p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nombre del Nodo</th>
                    <th class="text-center">CPU</th>
                    <th class="text-center">Memoria</th>
                    <th class="text-center">Disco</th>
                    <th class="text-center">Red</th>
                    <th class="text-center">Última Actualización</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nodes as $iNode)
                    @php
                        $measurement = $measurements[$iNode->name] ?? null;
                        $minutesSinceUpdate = $measurement ? now()->diffInMinutes($measurement['timestamp']) : 'No disponible';
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('server-status', ['node' => $iNode->name]) }}">
                                {{ $iNode->name }}
                            </a>
                        </td>
                        <td class="text-center">{{ $measurement ? round($measurement['cpu']) . '%' : 'No disponible' }}</td>
                        <td class="text-center">{{ $measurement ? round($measurement['memory']) . '%' : 'No disponible' }}</td>
                        <td class="text-center">{{ $measurement ? round($measurement['disk']) . '%' : 'No disponible' }}</td>
                        <td class="text-center">{{ $measurement ? round($measurement['network']) . ' Mbps' : 'No disponible' }}</td>
                        <td class="text-center">{{ $minutesSinceUpdate }} min</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if (empty($node))
    <div class="container mt-4">
        <h3>Jugadores en línea</h3>
        <canvas id="onlinePlayerHistoryChart"></canvas>
    </div>
    @endif
</div>

@if (!empty($node))
<div class="container">
    @include('pages.server-status.specifications')

    <!-- Monitor content -->
    @if ($node->enable_monitor)
    @include('pages.server-status.resources')

    @include('pages.server-status.sensors')

    @endif
</div>
@endif

@endsection
