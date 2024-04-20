@extends('base')

@section('description', 'Administracion interna de 4evergaming')

@section('robots', 'noindex, nofollow')

@section('title')
4evergaming: Panel de Administración
@endsection

@section('javascript')
<script type="module">
    var totalPaidAmountChart = document.getElementById('totalPaidAmountChart');
    var myChart = new Chart(totalPaidAmountChart, {
        type: 'bar',
        data: {
            labels: @json($totalPaid->pluck('label')->toArray()),
            datasets: [{
                radius: 1,
                label: 'Total recaudado',
                data: @json($totalPaid->pluck('total')->toArray()),
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

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div> <h4 class="text-center fw-bold"> Monto facturado este año </h4> </div>
            <div> <canvas id="totalPaidAmountChart"></canvas> </div>
        </div>
    </div>
</div>
@endsection