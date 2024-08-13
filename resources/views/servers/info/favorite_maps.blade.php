@section('javascript')
<script type="module">
    var favoriteMapsChart = document.getElementById('favoriteMapsChart');
    var myChart = new Chart(favoriteMapsChart, {
        type: 'pie',
        data: {
            labels: @json($server->favoriteMaps()->select('map', \DB::raw('COUNT(*) as count'))->groupBy('map')->orderBy('count', 'DESC')->limit(10)->pluck('map')->toArray()),
            datasets: [{
                label: 'Cantidad de veces jugadas',
                data: @json($server->favoriteMaps()->select('map', \DB::raw('COUNT(*) as count'))->groupBy('map')->orderBy('count', 'DESC')->limit(10)->pluck('count')->toArray()),
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@append

<div class="card mb-3">
    <div class="card-header"> <h4 class="text-center fw-bold"> Mapas favoritos </h4> </div>
    <div class="card-body"> <canvas id="favoriteMapsChart"></canvas> </div>
</div>