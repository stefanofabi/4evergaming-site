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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addServerModal"> Formulario para agregar Servidor </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <h4 class="fw-bold"> ¡Añadí tu servidor de juegos y llegá al Top! </h4>

        <p> 
          Unite a nuestra plataforma de estadísticas y rankings para mejorar tu audiencia y convertirte en el líder indiscutible. 
          Obtené análisis detallados, competí con jugadores de élite y atraé a nuevos seguidores a tu comunidad. 
          ¡No te conformes con menos, sé el protagonista de la competición y demostrá quién manda en el mundo gamer! 🔥🔥
        </p>
        
        <div class="row">
          <form id="serverForm">
            @csrf

            <div class="row">
              <div class="col-md-9">
                <label for="game_id" class="fw-bold"> Juego </label>
                  <select class="form-select" name="game_id" id="game_id" required>
                      <option value=""> Seleccioná el juego </option>
                      @foreach ($games as $game_aux)
                      <option value="{{ $game_aux->id }}" @if ($game == $game_aux) selected @endif> {{ $game_aux->name }}</option>
                      @endforeach
                  </select>
              </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-9">
                  <label for="ip" class="fw-bold"> Servidor </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="ip" id="ip" value="{{ old('ip') }}" placeholder="IP" aria-label="IP" required>
                        <span class="input-group-text">:</span>
                        <input type="number" class="form-control" name="port" value="{{ old('port') }}" placeholder="Puerto" aria-label="Puerto" min="0" max="65535" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-9">
                <div class="form-group">
                  <label for="description" class="fw-bold"> Descripción </label>
                  <textarea class="form-control" name="description" id="description" style="height: 100px" aria-describedby="nameHelp" @guest disabled @endguest></textarea>

                  <small id="nameHelp" class="form-text text-muted"> Una breve descripción de tu servidor y las reglas que se deben cumplir </small>
                </div>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-9">
                <label for="country" class="fw-bold"> País </label>
                
                <select class="form-select" name="country_id" id="country" required>
                  <option value="" selected> Seleccioná el país al que pertenece el servidor </option>
                    
                  @foreach ($countries as $country)
                  <option value="{{ $country->id }}"> {{ $country->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-9">
                <div> <label for="country" class="fw-bold"> Etiquetas del servidor </label> </div>

                @foreach ($game->gameTags as $game_tag)
                <div class="form-check form-check-inline mt-1">
                  <input class="form-check-input" type="checkbox" id="gameTag_{{ $game_tag->id }}" name="server_tags[]" value="{{ $game_tag->id }}">
                  <label class="form-check-label" for="gameTag_{{ $game_tag->id }}"> {{ $game_tag->name }} </label> 
                </div>
                @endforeach 
              </div>
            </div>   

            <input type="submit" class="d-none" id="serverFormSubmit">
          </form>
        </div>

        <div class="mt-3" id="responseServer"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-danger @guest disabled @endguest" id="addServerButton" onclick="addServer()"> Agregar servidor </button>
      </div>
    </div>
  </div>
</div>