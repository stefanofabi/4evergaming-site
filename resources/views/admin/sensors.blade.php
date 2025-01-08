@extends('admin.index')

@section('javascript')
@if (! empty($latencies))
<script type="module">
    function createCharts() {
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
    }

    // Inicializar gráficos al mostrar la pestaña activa
    document.addEventListener('DOMContentLoaded', function () {
        var tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (e) {
                createCharts();
            });
        });

        // Inicializar gráficos si la primera pestaña está activa por defecto
        createCharts();
    });
    
</script>
@endif
@endsection

@section('right-content')
<h1 class="mb-4"> Sensores </h1>
<div class="col-md-6">
    <form action="{{ route('admin/sensors') }}">
        <div class="row">
            <div class="col-auto">
                <select class="form-select" aria-label="Seleccione un Nodo" name="node">
                    <option value=""> Seleccione un Nodo </option>
                    @foreach($nodes as $iNode)
                    <option value="{{ $iNode->name }}" @if (!empty($node) && $node->id == $iNode->id) selected @endif> {{ $iNode->name }} </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-auto">
                <button type="submit" class="btn btn-danger mb-3"> Cargar nodo </button>
            </div>
        </div> 
    </form>
</div>

@if (! empty($node))
<div class="row mt-3">
    <div class="col-md">
        @foreach ($sensors as $iSensor)
            @if (! empty($sensor) && $sensor->id == $iSensor->id)
            <a class="btn btn-danger @if (! $iSensor->active) disabled @endif" href="{{ route('admin/sensors', ['node' => $node->name, 'sensor' => $iSensor->name]) }}"> 
                {{ $iSensor->name }} ({{ $iSensor->last_response_time }} ms)
            </a>
            @else
            <a class="btn btn-outline-danger @if (! $iSensor->active) disabled @endif" href="{{ route('admin/sensors', ['node' => $node->name, 'sensor' => $iSensor->name]) }}"> 
                {{ $iSensor->name }} ({{ $iSensor->last_response_time }} ms)
            </a>
            @endif
        @endforeach
    </div>
</div>

@if (! empty($sensor))
<div class="mt-3"><canvas id="latencyChart"></canvas></div>
@endif

@endif
@endsection