@section('javascript')
@if (!empty($node) && $node->enable_monitor)
<script type="module">
    function createCharts() {
        // Gráfico de CPU
        var cpuCtx = document.getElementById('cpuChart');
        var cpuData = @json($cpu); // Datos de CPU
        var averageCpu = cpuData.reduce((a, b) => a + b, 0) / cpuData.length;

        var cpuTempData = @json($cpu_temp); 
        var averageCpuTemp = cpuTempData.reduce((a, b) => a + b, 0) / cpuTempData.length;

        var cpuChart = new Chart(cpuCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'CPU',
                    data: cpuData,
                    borderColor: 'rgba(54, 162, 235, 1)', // Azul
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Azul claro
                    fill: false,
                    pointRadius: 0, // Esto oculta los puntos
                }, {
                    label: 'Temperatura CPU',
                    data: cpuTempData,
                    borderColor: 'rgba(255, 159, 64, 1)', // Naranja
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Naranja claro
                    fill: false,
                    pointRadius: 0,
                }, {
                    label: 'Promedio CPU',
                    // Crear un array con el promedio repetido para todas las etiquetas
                    data: @json($timestamps).map(() => averageCpu),
                    borderColor: 'rgba(75, 192, 192, 1)', // Verde claro
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Verde claro
                    borderDash: [5, 5], // Línea discontinua
                    fill: false,
                    pointRadius: 0,
                }, {
                    label: 'Promedio Temperatura CPU',
                    data: @json($timestamps).map(() => averageCpuTemp),
                    borderColor: 'rgba(255, 99, 132, 1)', // Rojo cálido
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Rojo cálido, transparente
                    borderDash: [5, 5], // Línea discontinua
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
                                } else if (context.dataset.label === 'Promedio CPU') {
                                    label += context.raw.toFixed(2) + ' %';
                                } else if (context.dataset.label === 'Promedio Temperatura CPU') {
                                    label += context.raw.toFixed(2) + ' %';
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
                }, {
                    label: 'Swap',
                    data: @json($swap),
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
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
                        min: 0,
                        max: 100,
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value + '%';
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
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw.toFixed(2) + '%';
                                return label;
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
                }, {
                    label: 'Esperas de disco',
                    data: @json($disk_wait),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                    pointRadius: 0,
                    yAxisID: 'y1',  // Usa el eje Y derecho
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
                                return value + ' MB/s'; // Agrega el sufijo MB/s para el eje izquierdo
                            }
                        },
                        title: {
                            display: true,
                            text: 'Uso de Disco (MB/s)'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        max: 100,  // Limita el eje derecho a 100%
                        ticks: {
                            callback: function(value, index, values) {
                                return value + '%'; // Agrega el sufijo % para el eje derecho
                            }
                        },
                        title: {
                            display: true,
                            text: 'Esperas de Disco (%)'
                        },
                        position: 'right' // Coloca el eje a la derecha
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
                                // Si el dataset es de % (esperas de disco), muestra el valor como porcentaje
                                if (context.dataset.label === 'Esperas de disco') {
                                    label += context.raw.toFixed(2) + '%';
                                } else {
                                    label += context.raw.toFixed(2) + ' MB/s';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });


        // Gráfico de Red
        var networkCtx = document.getElementById('networkChart');

        var networkReceiveData = @json($network_receive);
        var averageNetworkReceive = networkReceiveData.reduce((a, b) => a + b, 0) / networkReceiveData.length;
        
        var networkTransmitData = @json($network_transmit);
        var averageNetworkTransmit = networkTransmitData.reduce((a, b) => a + b, 0) / networkTransmitData.length;
        
        var networkChart = new Chart(networkCtx, {
            type: 'line',
            data: {
                labels: @json($timestamps),
                datasets: [{
                    label: 'Velocidad de bajada',
                    data: networkReceiveData,
                    borderColor: 'rgba(255, 205, 86, 1)',
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    fill: false,
                    pointRadius: 0,
                }, {
                    label: 'Velocidad de subida',
                    data: networkTransmitData,
                    borderColor: 'rgba(201, 203, 207, 1)',
                    backgroundColor: 'rgba(201, 203, 207, 0.2)',
                    fill: false,
                    pointRadius: 0,
                }, {
                    label: 'Promedio de velocidad de bajada',
                    data: @json($timestamps).map(() => averageNetworkReceive),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderDash: [10, 5], // Línea discontinua para diferenciar
                    fill: false,
                    pointRadius: 0,
                }, {
                    label: 'Promedio de velocidad de subida',
                    data: @json($timestamps).map(() => averageNetworkTransmit),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderDash: [10, 5], // Línea discontinua para diferenciar
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
                                if (context.dataset.label === 'Velocidad de bajada') {
                                    label += context.raw.toFixed(2) + ' Mbps';
                                } else if (context.dataset.label === 'Velocidad de subida') {
                                    label += context.raw.toFixed(2) + ' Mbps';
                                } else if (context.dataset.label === 'Promedio de de velocidad de bajada') {
                                    label += context.raw.toFixed(2) + ' Mbps';
                                } else if (context.dataset.label === 'Promedio de velocidad de subida') {
                                    label += context.raw.toFixed(2) + ' Mbps';
                                }
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



    <div class="mt-4">
        <h4 class="mt-3">Recursos</h4>

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