 <!-- Create new firewall rule -->
 <div class="modal fade" id="createRuleModal" tabindex="-1" aria-labelledby="createRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRuleModalLabel">Crear Nueva Regla de Firewall</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="firewallRuleForm">
                    @csrf 

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="source_ip" class="form-label">IP de Origen</label>
                                    <input type="text" class="form-control" id="source_ip" name="source_ip" required>
                                </div>

                                <div class="mb-3">
                                    <label for="flow" class="form-label">Flujo</label>
                                    <select class="form-select" id="flow" name="flow" required>
                                        <option value=""> Seleccione una opción </option>
                                        <option value="INPUT" selected> Entrante </option>
                                        <option value="OUTPUT"> Saliente </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="protocol" class="form-label">Protocolo</label>
                                    <select class="form-select" id="protocol" name="protocol" required>
                                        <option value="ANY" selected> Aplica a todos los protocolos </option>
                                        <option value="TCP"> TCP </option>
                                        <option value="UDP"> UDP </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="network_address_id" class="form-label">Dirección IP</label>
                                    <select class="form-select" id="network_address_id" name="network_address_id">
                                        <option value=""> Aplica a todas las direcciones ip </option>
                                        @foreach ($networkAddresses as $networkAddress)
                                        <option value="{{ $networkAddress->id }}"> {{ $networkAddress->ip_address }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="destination_port" class="form-label">Puerto Destino</label>
                                    <input type="number" class="form-control" id="destination_port" name="destination_port" placeholder="Aplica a todos los puertos">
                                </div>

                                <div class="mb-3">
                                    <label for="action" class="form-label">Acción</label>
                                    <select class="form-select" id="action" name="action" required>
                                        <option value=""> Seleccione una opción </option>
                                        <option value="ACCEPT"> Aceptar </option>
                                        <option value="DROP" selected> Descartar </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comentario</label>
                            <textarea class="form-control" id="comment" name="comment" placeholder="Opcionalmente colocá una referencia para poder reconocer la regla más tarde"></textarea>
                        </div>
                    </div>

                    <div class="m-3" id="responseFirewallRule"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
                        <button type="submit" class="btn btn-danger" id="addFirewallRuleButton" onclick="addFirewallRule()"> Guardar Regla </button>
                    </div>
                </form>
            </div>
        </div>
    </div>