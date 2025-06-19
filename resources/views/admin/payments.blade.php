@extends('admin.index')

@section('right-content')

<h2 class="mb-4">Listado de Pagos</h2>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Cliente</th>
                <th>Transacción</th>
                <th>Método</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td> 
                        @if ($payment->client_id)
                        <a href="https://clientes.4evergaming.com.ar/admin/clientssummary.php?userid={{ $payment->client_id }}">{{ $payment->first_name }} {{ $payment->last_name }} </a> 
                        @else
                        {{ $payment->first_name }} {{ $payment->last_name }}
                        @endif
                    </td>
                    <td>{{ $payment->transaction }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                    <td>${{ number_format($payment->amount, 2) }}</td>
                    <td>
                        @if($payment->status === 'Pendiente')
                            <span class="badge bg-warning text-dark">{{ $payment->status }}</span>
                        @elseif($payment->status === 'Completado')
                            <span class="badge bg-success">{{ $payment->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $payment->status }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay pagos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
