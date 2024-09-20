@extends('admin.index')

@section('javascript')
<script type="module">
    var gameHistoryCtx = document.getElementById('gameHistoryChart');
        var gameHistoryChart = new Chart(gameHistoryCtx, {
            type: 'line',
            data: {
                labels: @json($gameHistory['day']),
                datasets: [{
                    label: 'Jugadores en línea',
                    data: @json($gameHistory['count']),
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
                            text: 'Dia'
                        },
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 15 // Ajusta el número máximo de etiquetas visibles
                        }
                    },
                    y: {
                        beginAtZero: true,
                        min: 0,
                        title: {
                            display: true,
                            text: 'Cantidad de jugadores'
                        }
                    }
                }
            }
        });
</script>
@append

@section('right-content')
<h1 class="mb-4"> Historial de juegos </h1>
<div class="col-md-6">
    <form action="{{ route('admin/game_history') }}">
        <div class="row">
            <div class="col-auto">
                <select class="form-select" aria-label="Seleccione un juego" name="game">
                    <option value=""> Seleccione un juego </option>
                    @foreach($games as $iGame)
                    <option value="{{ $iGame->id }}" @if (!empty($game) && $game->id == $iGame->id) selected @endif> {{ $iGame->name }} </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-auto">
                <button type="submit" class="btn btn-danger mb-3"> Cargar historial del juego </button>
            </div>
        </div> 
    </form>
</div>

@if (! empty($game))
<div style="height: 400px"><canvas id="gameHistoryChart"></canvas></div>
@endif
@endsection