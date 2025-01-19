@extends('admin.index')

@section('javascript')
<script>
    function confirmRenew(subscriptionId) {
        if (confirm('¿Estás seguro de que deseas renovar esta suscripción?')) {
            document.getElementById('renewForm_' + subscriptionId).submit();
        }
    }

    function confirmCancel(subscriptionId) {
        if (confirm('¿Estás seguro de que deseas cancelar esta suscripción?')) {
            document.getElementById('cancelForm_' + subscriptionId).submit();
        }
    }
</script>
@append

@section('right-content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Clientes suscriptos</h1>

        <form action="{{ route('admin/subscriptions/synchronize') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                </svg>

                Sincronizar Suscripciones
            </button>
        </form>
    </div>

    @if($subscriptions->isEmpty())
        <div class="alert alert-warning" role="alert">
            No subscriptions found.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Celular</th>
                        <th>Fecha de cobro</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td> 
                                <a href="https://clientes.4evergaming.com.ar/admin/clientssummary.php?userid={{ $subscription->client_id }}" target="_blank"> 
                                    {{ $subscription->firstname }} {{ $subscription->lastname }}
                                </a> {{ $subscription->reference }}
                            </td>
                            <td>{{ $subscription->phonenumber }}</td>
                            <td>{{ \Carbon\Carbon::parse($subscription->next_payment_date)->format('d M Y') }}</td>

                            <td class="text-end">
                                <a href="{{ $subscription->subscription_link }}" target="_blank" class="btn btn-outline-dark btn-sm ms-1 @if (empty($subscription->subscription_link)) disabled @endif" @if (empty($subscription->subscription_link)) style="pointer-events: none; color: #6c757d;" @endif role="button" title="Ver suscripcion">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                    </svg>
                                </a>

                                <!-- Botón para renovar suscripción -->
                                <a href="#" class="btn btn-outline-dark btn-sm ms-1" onclick="confirmRenew({{ $subscription->id }});" role="button" title="Renovar suscripción">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                    </svg>
                                </a>
                            
                                <!-- Formulario de renovación oculto -->
                                <form id="renewForm_{{ $subscription->id }}" action="{{ route('admin/subscriptions/renew', ['id' => $subscription->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('POST') <!-- Cambia a 'POST' si es una operación de renovación -->
                                </form>
                                
                                <!-- Botón para cancelar suscripción -->
                                <a href="#" class="btn btn-outline-dark btn-sm ms-1" onclick="confirmCancel({{ $subscription->id }});" role="button" title="Cancelar suscripción">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708"/>
                                    </svg>
                                </a>

                                <!-- Formulario de cancelación -->
                                <form id="cancelForm_{{ $subscription->id }}" action="{{ route('admin/subscriptions/cancel', ['id' => $subscription->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
