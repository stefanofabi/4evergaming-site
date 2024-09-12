@extends('admin.index')

@section('javascript')
@if (!empty($node) && $node->enable_monitor)
<script type="module">
    // Función para crear gráficos
    function createCharts() {
        // Gráfico de CPU
        var cpuCtx = document.getElementById('cpuChart');
        var cpuChart = new Chart(cpuCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'CPU Total',
                    data: @json($cpu_total),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false,
                }]
            }
        });

        // Gráfico de Memoria
        var memoryCtx = document.getElementById('memoryChart');
        var memoryChart = new Chart(memoryCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Memory Used',
                    data: @json($memory_used),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                }]
            }
        });

        // Gráfico de Disco
        var diskCtx = document.getElementById('diskChart');
        var diskChart = new Chart(diskCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Disk Read',
                    data: @json($disk_read),
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    fill: false,
                }, {
                    label: 'Disk Write',
                    data: @json($disk_write),
                    borderColor: 'rgba(255, 99, 132, 0.7)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    fill: false,
                }]
            }
        });

        // Gráfico de Red
        var networkCtx = document.getElementById('networkChart');
        var networkChart = new Chart(networkCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Network Receive (Mbps)',
                    data: @json($network_receive_mbps),
                    borderColor: 'rgba(255, 205, 86, 1)',
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    fill: false,
                }, {
                    label: 'Network Transmit (Mbps)',
                    data: @json($network_transmit_mbps),
                    borderColor: 'rgba(201, 203, 207, 1)',
                    backgroundColor: 'rgba(201, 203, 207, 0.2)',
                    fill: false,
                }]
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
<div class="col-6">
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

@if (!empty($node))
<div class="mt-5">
    <h5>Especificaciones</h5>

    <ul>
        <li><strong>CPU:</strong> {{ $node->cpu_specification }} ({{ $node->cpu }})</li>
        <li><strong>RAM:</strong> {{ $node->ram_specification }} ({{ $node->ram }})</li>
        <li><strong>Disk:</strong> {{ $node->disk_specification }} ({{ $node->disk }})</li>
        <li><strong>Connection:</strong> {{ $node->connection_specification }} ({{ $node->connection }})</li>
        <li><strong>Power Supply:</strong> {{ $node->power_supply_specification }} ({{ $node->power_supply }})</li>
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

@if (!empty($node) && $node->enable_monitor)
<!-- Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="cpu-tab" data-bs-toggle="tab" href="#cpu" role="tab" aria-controls="cpu" aria-selected="true">Uso de CPU</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="memory-tab" data-bs-toggle="tab" href="#memory" role="tab" aria-controls="memory" aria-selected="false">Uso de Memoria</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="disk-tab" data-bs-toggle="tab" href="#disk" role="tab" aria-controls="disk" aria-selected="false">Uso de Disco</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="network-tab" data-bs-toggle="tab" href="#network" role="tab" aria-controls="network" aria-selected="false">Uso de Red</a>
    </li>
</ul>
<div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="cpu" role="tabpanel" aria-labelledby="cpu-tab">
        <div><canvas id="cpuChart"></canvas></div>
    </div>
    <div class="tab-pane fade" id="memory" role="tabpanel" aria-labelledby="memory-tab">
        <div><canvas id="memoryChart"></canvas></div>
    </div>
    <div class="tab-pane fade" id="disk" role="tabpanel" aria-labelledby="disk-tab">
        <div><canvas id="diskChart"></canvas></div>
    </div>
    <div class="tab-pane fade" id="network" role="tabpanel" aria-labelledby="network-tab">
        <div><canvas id="networkChart"></canvas></div>
    </div>
</div>
@else 
<p class="text-danger"> Monitor deshabilitado </p>
@endif
@endsection
