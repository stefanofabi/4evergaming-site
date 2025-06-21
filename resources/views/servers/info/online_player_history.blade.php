@section('javascript')
<script type="module">
const stats = {
  hourly:  @json($server->stats_hourly),
  daily:   @json($server->stats_daily),
  monthly: @json($server->stats_monthly)
};

const ctx = document.getElementById('onlinePlayerHistoryChart').getContext('2d');
const chart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: stats.hourly.map(i => i.date),
    datasets: [{
      radius: 1,
      label: 'Jugadores online (24h)',
      data: stats.hourly.map(i => i.count),
      backgroundColor: '#f47363',
      borderColor: '#f47363',
      fill: true
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: { ticks: { maxTicksLimit: 5 } },
      y: { min: 0 }
    }
  }
});

function updateChart(periodKey, labelText) {
  const arr = stats[periodKey];
  chart.data.labels = arr.map(i => i.date);
  chart.data.datasets = [{
    radius: 1,
    label: labelText,
    data: arr.map(i => i.count),
    backgroundColor: '#f47363',
    borderColor: '#f47363',
    fill: true
  }];
  chart.update();
}

function setActive(btnId) {
  document.querySelectorAll('.btn-group .btn').forEach(b => b.classList.remove('active'));
  document.getElementById(btnId).classList.add('active');
}

document.getElementById('btn_hourly').addEventListener('click', () => {
  updateChart('hourly', 'Jugadores online (24h)');
  setActive('btn_hourly');
});

document.getElementById('btn_daily').addEventListener('click', () => {
  updateChart('daily', 'Jugadores online (30 días)');
  setActive('btn_daily');
});

document.getElementById('btn_monthly').addEventListener('click', () => {
  updateChart('monthly', 'Jugadores online (mensual)');
  setActive('btn_monthly');
});
</script>
@append

<div class="container my-4 mt-5">
  <h4 class="text-center fw-bold">Histórico de jugadores</h4>

  <div class="d-flex justify-content-center">
    <div class="btn-group" role="group" aria-label="Gráficos de jugadores online">
      <button id="btn_hourly" type="button" class="btn btn-outline-danger btn-sm active">24 Horas</button>
      <button id="btn_daily" type="button" class="btn btn-outline-danger btn-sm">30 Días</button>
      <button id="btn_monthly" type="button" class="btn btn-outline-danger btn-sm">Mensual</button>
    </div>
  </div>

  <div class="p-4" style="height: 400px">
    <canvas id="onlinePlayerHistoryChart"></canvas>
  </div>
</div>
