@section('javascript')
<script type="module">
  $("#uploadMapForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('servers/upload_map') }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function(){
                $('#uploadMapButton').addClass("disabled");
                $('#uploadMapForm').css("opacity",".5");
                $('#responseUploadMap').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseUploadMap').html('<span style="font-size:18px;color:#34A853"> '+ response.message +'  </span>');
            $('#uploadMapForm').css("opacity","");
            $("#uploadMapButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseUploadMap').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#uploadMapForm').css("opacity","");
            $("#uploadMapButton").removeClass("disabled");
          });
  });
</script>

<script>
  function uploadMap() 
  {
    $('#uploadMapSubmit').click();
  }
</script>
@append

<!-- Modal -->
<div class="modal fade" id="uploadMapModal" tabindex="-1" aria-labelledby="uploadMapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadMapModalLabel"> Formulario para subir mapa del servidor </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <h4> Subir mapa {{ $server->map }} </h4>
        @guest
        <div class="text-danger"> Antes de poder cargar el mapa del servidor, es necesario que <a href="{{ route('login') }}"> inicies sesión </a> </div> 
        @endguest

        <p> Recordá subir imágenes con buena calidad y en formato JPG </p>

        <div class="row">
          <form id="uploadMapForm" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="mapname" value="{{ $server->map }}">
            <input type="hidden" name="server_id" value="{{ $server->id }}">

            <div class="form-group col-md-9">
              <label for="map" class="fw-bold"> Mapa </label>
              <input type="file" class="form-control" name="map" id="map" value="" aria-describedby="mapHelp" required @guest disabled @endguest>

              <small id="mapHelp" class="form-text text-muted"> Subí la imágen que corresponde al mapa del servidor </small>
            </div>


            <input type="submit" class="d-none" id="uploadMapSubmit">
          </form>
        </div>

        <div class="mt-3" id="responseUploadMap"></div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-danger @guest disabled @endguest" id="uploadMapButton" onclick="uploadMap()"> Subir </button>
      </div>
    </div>
  </div>
</div>