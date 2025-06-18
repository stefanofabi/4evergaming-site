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
    <div class="modal-content text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
      
      <div class="modal-header border-0">
        <h5 class="modal-title" id="editServerModalLabel">🛠️ Formulario para editar servidor</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <p>Mantené la información de tu servidor actualizada para que podamos boostear tu servidor lo máximo posible.</p>

        <form id="updateServerForm">
          @csrf

          <div class="mb-3">
            <label for="game_id" class="form-label fw-bold">🎮 Juego</label>
            <select class="form-select bg-dark text-light border-secondary" name="game_id" id="game_id" required>
              <option value="">Seleccioná el juego</option>
              @foreach ($games as $game)
                <option value="{{ $game->id }}" @if ($server->game_id == $game->id) selected @endif>{{ $game->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label fw-bold">📝 Descripción</label>
            <textarea class="form-control bg-dark text-light border-secondary" name="description" id="description" style="height: 100px" aria-describedby="descriptionHelp">{{ $server->description }}</textarea>
            <small id="descriptionHelp" class="form-text text-muted">Una breve descripción de tu servidor y las reglas que se deben cumplir.</small>
          </div>

          <div class="mb-3">
            <label for="country" class="form-label fw-bold">🌍 País</label>
            <select class="form-select bg-dark text-light border-secondary" name="country_id" id="country" required>
              <option value="">Seleccioná el país al que pertenece el servidor</option>
              @foreach ($countries as $country)
                <option value="{{ $country->id }}" @if ($country->id == $server->country_id) selected @endif>{{ $country->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">🏷️ Etiquetas del servidor</label>
            <div>
              @foreach ($server->game->gameTags as $game_tag)
                <div class="form-check form-check-inline mt-1">
                  <input class="form-check-input" type="checkbox" id="gameTag_{{ $game_tag->id }}" name="server_tags[]" value="{{ $game_tag->id }}" @if ($server->serverTags->pluck('game_tag_id')->contains($game_tag->id)) checked @endif>
                  <label class="form-check-label text-light" for="gameTag_{{ $game_tag->id }}">{{ $game_tag->name }}</label>
                </div>
              @endforeach
            </div>
          </div>

          <input type="submit" class="d-none" id="updateServerFormSubmit">
        </form>

        <div class="mt-3" id="responseUpdateServer"></div>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-danger @guest disabled @endguest" id="updateServerButton" onclick="updateServer()">Actualizar servidor</button>
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
      
    </div>
  </div>
</div>
