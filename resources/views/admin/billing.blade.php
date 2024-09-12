@extends('admin.index')

@section('javascript')
<script type="module">
    var moreFrequentPaymentMethodsChart = document.getElementById('moreFrequentPaymentMethodsChart');
    var myChart = new Chart(moreFrequentPaymentMethodsChart, {
        type: 'pie',
        data: {
            labels: @json($moreFrequentPaymentMethods->pluck('label')->toArray()),
            datasets: [{
                label: 'Cantidad de operaciones',
                data: @json($moreFrequentPaymentMethods->pluck('count')->toArray()),
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

<script type="module">
    var billingChart = document.getElementById('billingChart');
    var myChart = new Chart(billingChart, {
        type: 'bar',
        data: {
            labels: @json($billing['timeline']),
            datasets: @json($billing['datasets'])
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                x: {
                    ticks: {
                        maxTicksLimit: 5
                    },
                    stacked: true
                },
                y: {
                    //type: 'logarithmic',
                    min: 0,
                    ticks: {
                        callback: function(value, index, values) {
                            // Formateo de los valores en el eje y como moneda
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                stacked: true
            }
        }
    });
</script>

<script type="module">
    var billingByYearChart = document.getElementById('billingByYearChart');
    var myChart = new Chart(billingByYearChart, {
        type: 'bar',
        data: {
            labels: @json($billingByYear['timeline']),
            datasets: @json($billingByYear['datasets'])
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                x: {
                    ticks: {
                        maxTicksLimit: 5
                    },
                    stacked: true
                },
                y: {
                    //type: 'logarithmic',
                    min: 0,
                    ticks: {
                        callback: function(value, index, values) {
                            // Formateo de los valores en el eje y como moneda
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                stacked: true
            }
        }
    });
</script>
@append

@section('right-content')
<div class="row"> 
    <div class="col">
        <div class="border p-4 mb-3 rounded bg-light text-dark">
            <span class="fs-4 fw-bold"> Total cobrado </span>
            @forelse ($billingToday as $payment)
                <div style="color: {{ $payment->color }};">
                    <span class="fs-4 fw-bold">{{ $payment->currency_code }} {{ $payment->total }}</span>
                </div>
            @empty
                <div class="text-danger fs-4 fw-bold">
                    No hay cobros hasta el momento
                </div>
            @endforelse
        </div>   
    </div>

    <div class="col">
        <div> <h4 class="text-center fw-bold"> Medios de pago más frecuentes </h4> </div>
        <div> <canvas id="moreFrequentPaymentMethodsChart"></canvas> </div>
    </div>
</div>
            
<div class="m-5">
    <div> <h4 class="text-center fw-bold"> Monto facturado este año </h4> </div>
    <div> <canvas id="billingChart"></canvas> </div>
</div>

<div class="m-5">
    <div> <h4 class="text-center fw-bold"> Monto facturado por año </h4> </div>
    <div> <canvas id="billingByYearChart"></canvas> </div>
</div>
@endsection