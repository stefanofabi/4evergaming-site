@extends('admin.index')

@section('javascript')
<script type="module">
  $("#firewallRuleForm").on('submit', function(e){
    e.preventDefault();

    const input = document.getElementById('source_ip').value;
    if (!isValidCIDR(input)) {
        event.preventDefault();
        alert("La direccion ip debe estar en formato CIDR");
        return;
    }
    
    $.ajax({
            type: 'POST',
            url: "{{ route('admin/firewall/store') }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function(){
                $('#addFirewallRuleButton').addClass("disabled");
                $('#firewallRuleForm').css("opacity",".5");
                $('#responseFirewallRule').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseFirewallRule').html('<span style="font-size:18px;color:#34A853"> Regla agregada exitosamente  </span>');
            $('#firewallRuleForm').css("opacity", "");
            $("#addFirewallRuleButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseFirewallRule').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#firewallRuleForm').css("opacity", "");
            $("#addFirewallRuleButton").removeClass("disabled");
          });
  });
</script>

<script>
    function addFirewallRule() 
    {
        $('#firewallRullFormSubmit').click();
    }

    function isValidCIDR(value) 
    {
        // Expresión regular para validar IPv4 con CIDR
        const ipv4CIDRPattern = /^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\/([0-9]|[1-2][0-9]|3[0-2])$/;
            
        // Expresión regular para validar IPv6 con CIDR (simplificada)
        const ipv6CIDRPattern = /^([0-9a-fA-F:]{2,39})\/([0-9]|[1-9][0-9]|1[0-1][0-9]|12[0-8])$/;

        return ipv4CIDRPattern.test(value) || ipv6CIDRPattern.test(value);
    }
</script>
@append

@section('right-content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Reglas de Firewall</h1>
        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createRuleModal">
            Crear Nueva Regla
        </button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>IP de Origen</th>
                <th> Flujo </th>
                <th> Protocolo </th>
                <th> Dirección IP </th>
                <th> Puerto Destino </th>
                <th> Acción </th>
                <th> Comentario </th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($firewallRules as $rule)
                <tr>
                    <td> {{ $rule->source_ip }} </td>
                    <td> {{ $rule->flow }} </td>
                    <td> {{ $rule->protocol }} </td>
                    <td> {{ $rule->networkAddress->ip_address ?? 'ANY' }} </td>
                    <td> {{ $rule->destination_port ?? 'ANY' }} </td>
                    <td> {{ $rule->action }} </td>
                    <td> {{ $rule->comment ?? 'N/A' }} </td>
                    <td class="text-end">
                        <form action="{{ route('admin/firewall/destroy', ['id' => $rule->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta regla?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No se encontraron reglas de firewall.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

   @include('admin/firewall/create')
</div>
@endsection
