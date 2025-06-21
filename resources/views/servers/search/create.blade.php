@section('javascript')
<script type="module">
  $("#serverForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('servers/store') }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function(){
                $('#addServerButton').addClass("disabled");
                $('#serverForm').css("opacity",".5");
                $('#responseServer').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseServer').html('<span style="font-size:18px;color:#34A853"> Servidor '+ response.hostname +' agregado exitosamente  </span>');
            $('#serverForm').css("opacity","");
            $("#addServerButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseServer').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#serverForm').css("opacity","");
            $("#addServerButton").removeClass("disabled");
          });
  });
</script>

<script>
  function addServer() 
  {
    $('#serverFormSubmit').click();
  }
</script>
@append

<!-- Modal -->
<div class="modal fade" id="addServerModal" tabindex="-1" aria-labelledby="addServerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="addServerModalLabel">Añadí tu Servidor y llegá al Top!</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p>
          Unite a nuestra plataforma de estadísticas para mejorar tu audiencia y convertirte en el líder indiscutible.
          Obtené análisis detallados, competí con jugadores de élite y atraé a nuevos seguidores a tu Comunidad.
        </p>

        <div class="row">
          <form id="serverForm">
            @csrf

            <div class="row">
              <div class="col-md-9">
                <label for="game_id" class="fw-bold">Juego</label>
                <select class="form-select bg-dark text-light border-secondary" name="game_id" id="game_id" required>
                  <option value="">Seleccioná el juego</option>
                  @foreach ($games as $game_aux)
                    <option value="{{ $game_aux->id }}" @if (isset($game) && $game == $game_aux) selected @endif>{{ $game_aux->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-9">
                <label for="ip" class="fw-bold">Servidor</label>
                <div class="input-group">
                  <input type="text" class="form-control bg-dark text-light border-secondary" name="ip" id="ip" value="{{ old('ip') }}" placeholder="IP" aria-label="IP" required>
                  <span class="input-group-text bg-dark text-light border-secondary">:</span>
                  <input type="number" class="form-control bg-dark text-light border-secondary" name="port" value="{{ old('port') }}" placeholder="Puerto" aria-label="Puerto" min="0" max="65535" required>
                </div>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-9">
                <label for="description" class="fw-bold">Descripción</label>
                <textarea class="form-control bg-dark text-light border-secondary" name="description" id="description" style="height: 100px" aria-describedby="nameHelp" @guest disabled @endguest></textarea>
                <small id="nameHelp" class="form-text text-light">Una breve descripción de tu servidor y las reglas que se deben cumplir</small>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-9">
                <label for="country" class="fw-bold">País</label>
                <select class="form-select bg-dark text-light border-secondary" name="country_id" id="country" required>
                  <option value="" selected>Seleccioná el país al que pertenece el servidor</option>
                  @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            @if (isset($game))
              <div class="row mt-3">
                <div class="col-md-9">
                  <label for="tags" class="fw-bold">Etiquetas del servidor</label>
                  @foreach ($game->gameTags as $game_tag)
                    <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="checkbox" id="gameTag_{{ $game_tag->id }}" name="server_tags[]" value="{{ $game_tag->id }}">
                      <label class="form-check-label" for="gameTag_{{ $game_tag->id }}">{{ $game_tag->name }}</label>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            <input type="submit" class="d-none" id="serverFormSubmit">
          </form>
        </div>

        <div class="mt-3" id="responseServer"></div>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-danger text-light border-light @guest disabled @endguest" id="addServerButton" onclick="addServer()">Agregar servidor</button>
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>