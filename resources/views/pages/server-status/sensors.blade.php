@section('javascript')
@if (!empty($node) && $node->enable_monitor)
<script type="module">
    function createChartsNew() {
        @if (! empty($latencies))
        // Gráfico de Latencia
        var latencyCtx = document.getElementById('latencyChart');
        var latencyChart = new Chart(latencyCtx, {
            type: 'line',
            data: {
                labels: @json($latencies->pluck('measurement_date')),
                datasets: [{
                    label: 'Latencia',
                    data: @json($latencies->pluck('response_time')),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                    pointRadius: 0,
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Hora'
                        },
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 10 // Ajusta el número máximo de etiquetas visibles
                        }
                    },
                    y: {
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            callback: function(value, index, values) {
                                return value + ' ms';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Latencia (ms)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toFixed(2) + ' ms';
                            }
                        }
                    }
                }
            }    
        });
        @endif
    }


    // Inicializar gráficos al mostrar la pestaña activa
    document.addEventListener('DOMContentLoaded', function () {
        var tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (e) {
                createChartsNew();
            });
        });

        // Inicializar gráficos si la primera pestaña está activa por defecto
        createChartsNew();
    });
</script>
@endif
@append

    <h4 class="mt-3">Sensores</h4>
    <div class="row mt-3">
        <div class="col-md">
            @foreach ($sensors as $iSensor)
                @if (! empty($sensor) && $sensor->id == $iSensor->id)
                <a class="btn btn-danger @if (! $iSensor->active) disabled @endif" href="{{ route('server-status', ['node' => $node->name, 'sensor' => $iSensor->name]) }}"> 
                    {{ $iSensor->name }} ({{ $iSensor->last_response_time }} ms)
                </a>
                @else
                <a class="btn btn-outline-danger @if (! $iSensor->active) disabled @endif" href="{{ route('server-status', ['node' => $node->name, 'sensor' => $iSensor->name]) }}"> 
                    {{ $iSensor->name }} ({{ $iSensor->last_response_time }} ms)
                </a>
                @endif
            @endforeach
        </div>
    </div>

    @if (! empty($sensor))
    <div class="mt-3" style="height: 400px"><canvas id="latencyChart"></canvas></div>
    @endif