@section('javascript')
<script type="module">
    var onlinePlayerHistoryChart = document.getElementById('onlinePlayerHistoryChart');
    var myChart = new Chart(onlinePlayerHistoryChart, {
        type: 'line',
        data: {
            labels: @json($server->onlinePlayerHistories()->select(DB::raw("DATE_FORMAT(updated_at, '%D %M') as day"))->get()->pluck('day')->toArray()),
            datasets: [{
                radius: 1,
                label: 'Cantidad de jugadores en línea',
                data: @json($server->onlinePlayerHistories()->pluck('count')->toArray()),
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
</script>
@append

<div class="card">
    <div class="card-header"> <h4 class="text-center fw-bold"> Jugadores online histórico </h4> </div>
    <div class="card-body"> <canvas id="onlinePlayerHistoryChart"></canvas> </div>
</div>