@section('javascript')
<script type="module">
    var stats_30_days = @json(collect($server->stats_30_days)->toArray());
    var stats_1_year = @json(collect($server->stats_1_year)->toArray());
    var stats_3_years = @json(collect($server->stats_3_years)->toArray());
    var stats_5_years = @json(collect($server->stats_5_years)->toArray());
    var stats_10_years = @json(collect($server->stats_10_years)->toArray());

    function getChartData(stats) {
        return {
            labels: stats.map(item => item.date),
            data: stats.map(item => item.count)
        };
    }

    var onlinePlayerHistoryChart = document.getElementById('onlinePlayerHistoryChart');
    var chart = new Chart(onlinePlayerHistoryChart, {
        type: 'line',
        data: {
            labels: getChartData(stats_30_days).labels,
            datasets: [{
                radius: 1,
                label: 'Cantidad de jugadores en línea (30 días)',
                data: getChartData(stats_30_days).data,
                backgroundColor: '#f47363',
                borderColor: '#f47363',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        maxTicksLimit: 5
                    }
                },
                y: {
                    min: 0
                }
            }
        }
    });

    function updateChart(stats, label, color) {
        chart.data.labels = getChartData(stats).labels;
        chart.data.datasets[0].data = getChartData(stats).data;
        chart.data.datasets[0].label = label;
        chart.data.datasets[0].borderColor = color;
        chart.data.datasets[0].backgroundColor = color;
        chart.update();
    }

    document.getElementById('btn_30_days').addEventListener('click', function() {
        updateChart(stats_30_days, 'Cantidad de jugadores en línea (30 días)', '#f47363');
    });

    document.getElementById('btn_1_year').addEventListener('click', function() {
        updateChart(stats_1_year, 'Cantidad de jugadores en línea (1 año)', '#f47363');
    });

    document.getElementById('btn_3_years').addEventListener('click', function() {
        updateChart(stats_3_years, 'Cantidad de jugadores en línea (3 años)', '#f47363');
    });

    document.getElementById('btn_5_years').addEventListener('click', function() {
        updateChart(stats_5_years, 'Cantidad de jugadores en línea (5 años)', '#f47363');
    });

    document.getElementById('btn_10_years').addEventListener('click', function() {
        updateChart(stats_10_years, 'Cantidad de jugadores en línea (10 años)', '#f47363');
    });
</script>
@append

<div class="container my-4 mt-5">
    <h4 class="text-center fw-bold"> Histórico de jugadores </h4>

    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group" aria-label="Gráficos de jugadores online">
            <button id="btn_30_days" type="button" class="btn btn-outline-danger btn-sm">30 Días</button>
            <button id="btn_1_year" type="button" class="btn btn-outline-danger btn-sm">1 Año</button>
            <button id="btn_3_years" type="button" class="btn btn-outline-danger btn-sm">3 Años</button>
            <button id="btn_5_years" type="button" class="btn btn-outline-danger btn-sm">5 Años</button>
            <button id="btn_10_years" type="button" class="btn btn-outline-danger btn-sm">10 Años</button>
        </div>
    </div>

    <div class="p-4" style="height: 400px">
        <canvas id="onlinePlayerHistoryChart"></canvas>
    </div>
</div>
