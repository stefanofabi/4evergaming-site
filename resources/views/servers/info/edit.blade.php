@section('javascript')
<script type="module">
  $("#updateServerForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('servers/update', ['id' => $server->id]) }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function(){
                $('#updateServerButton').addClass("disabled");
                $('#updateServerForm').css("opacity",".5");
                $('#responseUpdateServer').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseUpdateServer').html('<span style="font-size:18px;color:#34A853"> Servidor '+ response.hostname +' actualizado exitosamente  </span>');
            $('#updateServerForm').css("opacity","");
            $("#updateServerButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseUpdateServer').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#updateServerForm').css("opacity","");
            $("#updateServerButton").removeClass("disabled");
          });
  });
</script>

<script>
  function updateServer() 
  {
    $('#updateServerFormSubmit').click();
  }
</script>
@append

<!-- Modal -->
<div class="modal fade" id="editServerModal" tabindex="-1" aria-labelledby="editServerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editServerModal"> Formulario para editar servidor </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p> Mantené la información de tu servidor actualizada para que podamos boostear tu servidor lo máximo posible </p>
        <div class="row">
          <form id="updateServerForm">
            @csrf

            <div class="row">
              <div class="col-md-9">
                <label for="game_id" class="fw-bold"> Juego </label>
                  <select class="form-select" name="game_id" id="game_id" required>
                      <option value=""> Seleccioná el juego </option>
                      @foreach ($games as $game)
                      <option value="{{ $game->id }}" @if ($server->game_id == $game->id) selected @endif> {{ $game->name }}</option>
                      @endforeach
                  </select>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-9">
                <div class="form-group">
                  <label for="description" class="fw-bold"> Descripción </label>
                  <textarea class="form-control" name="description" id="description" style="height: 100px" aria-describedby="descriptionHelp">{{ $server->description }}</textarea>

                  <small id="descriptionHelp" class="form-text text-muted"> Una breve descripción de tu servidor y las reglas que se deben cumplir </small>
                </div>
              </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-9">
                  <label for="country" class="fw-bold"> País </label>
                    <select class="form-select" name="country_id" id="country" required>
                        <option value="" selected> Seleccioná el país al que pertenece el servidor </option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if ($country->id == $server->country_id) selected @endif> {{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="submit" class="d-none" id="updateServerFormSubmit">
          </form>
        </div>

        <div class="mt-3" id="responseUpdateServer"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-danger @guest disabled @endguest" id="updateServerButton" onclick="updateServer()"> Actualizar servidor </button>
      </div>
    </div>
  </div>
</div>