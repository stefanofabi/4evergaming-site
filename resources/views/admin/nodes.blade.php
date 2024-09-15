@extends('admin.index')

@section('javascript')
@if (!empty($node) && $node->enable_monitor)
<script type="module">
    function createCharts() {
        // Gráfico de CPU
        var cpuCtx = document.getElementById('cpuChart');
        var cpuChart = new Chart(cpuCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'CPU',
                    data: @json($cpu),
                    borderColor: 'rgba(54, 162, 235, 1)', // Azul
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Azul claro
                    fill: false,
                    pointRadius: 0, // Esto oculta los puntos
                }, {
                    label: 'Temperatura CPU',
                    data: @json($cpu_temp),
                    borderColor: 'rgba(255, 159, 64, 1)', // Naranja
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Naranja claro
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
                            maxTicksLimit: 10
                        }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        id: 'cpu-y-axis',
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + ' %';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Uso de CPU (%)'
                        }
                    },
                    y2: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        id: 'temp-y-axis',
                        min: 0, // Ajusta el rango según la temperatura esperada
                        max: 100, // Ajusta el rango según la temperatura esperada
                        ticks: {
                            callback: function(value) {
                                return value + ' °C'; // Ajusta la unidad de temperatura si es necesario
                            }
                        },
                        title: {
                            display: true,
                            text: 'Temperatura CPU (°C)'
                        },
                        grid: {
                            drawOnChartArea: false // Oculta las líneas de la cuadrícula en esta escala
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.dataset.label === 'CPU') {
                                    label += context.raw.toFixed(2) + ' %';
                                } else if (context.dataset.label === 'Temperatura CPU') {
                                    label += context.raw.toFixed(2) + ' °C';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Memoria
        var memoryCtx = document.getElementById('memoryChart');
        var memoryChart = new Chart(memoryCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Memoria',
                    data: @json($memory),
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
                        max: 100, 
                        ticks: {
                            callback: function(value, index, values) {
                                return value + ' %';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Uso de Memoria (%)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toFixed(2) + ' %';
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Disco
        var diskCtx = document.getElementById('diskChart');
        var diskChart = new Chart(diskCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Disco',
                    data: @json($disk),
                    borderColor: 'rgba(54, 162, 235, 1)', // Azul
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Azul claro
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
                        max: 100, 
                        ticks: {
                            callback: function(value, index, values) {
                                return value + ' %';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Uso de Disco (%)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toFixed(2) + ' %';
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Disco IO
        var diskIOCtx = document.getElementById('diskIOChart');
        var diskIOChart = new Chart(diskIOCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Lectura de disco',
                    data: @json($disk_read),
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    fill: false,
                    pointRadius: 0,
                }, {
                    label: 'Escritura de disco',
                    data: @json($disk_write),
                    borderColor: 'rgba(255, 99, 132, 0.7)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
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
                        ticks: {
                            callback: function(value, index, values) {
                                return value + ' MB/s'; // Agrega el sufijo MB/s
                            }
                        },
                        title: {
                            display: true,
                            text: 'Uso de Disco (MB/s)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw.toFixed(2) + ' MB/s';
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Red
        var networkCtx = document.getElementById('networkChart');
        var networkChart = new Chart(networkCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Velocidad de bajada',
                    data: @json($network_receive),
                    borderColor: 'rgba(255, 205, 86, 1)',
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    fill: false,
                    pointRadius: 0,
                }, {
                    label: 'Velocidad de subida',
                    data: @json($network_transmit),
                    borderColor: 'rgba(201, 203, 207, 1)',
                    backgroundColor: 'rgba(201, 203, 207, 0.2)',
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
                        ticks: {
                            callback: function(value, index, values) {
                                return value + ' Mbps'; // Agrega el sufijo Mbps
                            }
                        },
                        title: {
                            display: true,
                            text: 'Uso de Red (Mbps)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw.toFixed(2) + ' Mbps';
                                return label;
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
@append

@section('right-content')
<h1 class="mb-4">Nodos</h1>
<div class="col-md-6">
    <form action="{{ route('admin/nodes') }}">
        <div class="row">
            <div class="col-auto">
                <select class="form-select" aria-label="Seleccione un Nodo" name="node">
                    <option value=""> Seleccione un Nodo </option>
                    @foreach($nodes as $iNode)
                    <option value="{{ $iNode->id }}" @if (!empty($node) && $node->id == $iNode->id) selected @endif> {{ $iNode->name }} </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-auto">
                <button type="submit" class="btn btn-danger mb-3"> Cargar nodo </button>
            </div>
        </div> 
    </form>
</div>


<!-- Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <!-- Monitor Tab -->
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="monitor-tab" data-bs-toggle="tab" href="#monitor" role="tab" aria-controls="monitor" aria-selected="true"> Monitor </a>
    </li>

    <!-- Specifications Tab -->
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="specifications-tab" data-bs-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false"> Especificaciones </a>
    </li>
</ul>

<div class="tab-content mt-3">
    <!-- Specifications Content -->
    <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
        @if (!empty($node))
        <div class="mt-5">
            <h5>Especificaciones</h5>
            <ul>
                <li><strong>CPU:</strong> {{ $node->cpu_specification }} </li>
                <li><strong>RAM:</strong> {{ $node->memory_specification }} </li>
                <li><strong>Disk:</strong> {{ $node->disk_specification }} </li>
                <li><strong>Connection:</strong> {{ $node->connection_specification }} </li>
                <li><strong>Power Supply:</strong> {{ $node->power_supply_specification }} </li>
                <li><strong>Operating System:</strong> {{ $node->operating_system }}</li>

                <li><strong>PHPMyAdmin:</strong> 
                    @if (empty($node->phpmyadmin))
                    <a href="#"> Ingresar </a>
                    @else 
                    <a href="{{ $node->phpmyadmin }}" target="_blank"> Ingresar </a> 
                    @endif
                </li>
            </ul>
        </div>
        @endif
    </div>

    <!-- Monitor content -->
    @if (!empty($node) && $node->enable_monitor)
    <div class="tab-pane fade show active" id="monitor" role="tabpanel" aria-labelledby="monitor-tab">
        <div class="container mt-4">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="p-3 rounded bg-danger text-white">
                        <div class="h1 mb-0"> {{ $current_cpu }}% </div>
                        <div>CPU</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="p-3 rounded bg-primary text-white">
                        <div class="h1 mb-0"> {{ $current_memory }}%  </div>
                        <div>Memoria</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="p-3 rounded bg-success text-white">
                        <div class="h1 mb-0"> {{ $current_disk }}% </div>
                        <div>Disco</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="p-3 rounded bg-warning text-dark">
                        <div class="h1 mb-0"> {{ $current_network }} Mbps </div>
                        <div>Red</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-3">
            <small class="text-muted fst-italic"> Última actualización: {{ $current_measurement_date }} </small>
        </div>

        <!-- Monitor graphs -->
        <ul class="nav nav-tabs" id="monitorTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="cpu-tab" data-bs-toggle="tab" href="#cpu" role="tab" aria-controls="cpu" aria-selected="true"> CPU </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="memory-tab" data-bs-toggle="tab" href="#memory" role="tab" aria-controls="memory" aria-selected="false"> Memoria </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="disk-tab" data-bs-toggle="tab" href="#disk" role="tab" aria-controls="disk" aria-selected="false"> Disco </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="disk-io-tab" data-bs-toggle="tab" href="#disk-io" role="tab" aria-controls="disk-io" aria-selected="false"> Disco I/O </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="network-tab" data-bs-toggle="tab" href="#network" role="tab" aria-controls="network" aria-selected="false"> Red </a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="cpu" role="tabpanel" aria-labelledby="cpu-tab">
                <div style="height: 400px"><canvas id="cpuChart"></canvas></div>
            </div>
            <div class="tab-pane fade" id="memory" role="tabpanel" aria-labelledby="memory-tab">
                <div style="height: 400px"><canvas id="memoryChart"></canvas></div>
            </div>
            <div class="tab-pane fade" id="disk" role="tabpanel" aria-labelledby="disk-tab">
                <div style="height: 400px"><canvas id="diskChart"></canvas></div>
            </div>
            <div class="tab-pane fade" id="disk-io" role="tabpanel" aria-labelledby="disk-io-tab">
                <div style="height: 400px"><canvas id="diskIOChart"></canvas></div>
            </div>
            <div class="tab-pane fade" id="network" role="tabpanel" aria-labelledby="network-tab">
                <div style="height: 400px"><canvas id="networkChart"></canvas></div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection