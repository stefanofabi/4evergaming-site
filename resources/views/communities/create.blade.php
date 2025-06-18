@section('javascript')
<script type="module">
  $("#communityForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('communities/store') }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#saveCommunityButton').addClass("disabled");
                $('#communityForm').css("opacity",".5");
                $('#responseCommunity').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseCommunity').html('<span style="font-size:18px;color:#34A853"> Comunidad '+ response.name +' agregada exitosamente </span>');
            $('#communityForm').css("opacity","");
            $("#saveCommunityButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseCommunity').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#communityForm').css("opacity","");
            $("#saveCommunityButton").removeClass("disabled");
          });
  });
</script>


<script>
  function saveCommunity() 
  {
    $('#communityFormSubmitButton').click();
  }
</script>
@append

<!-- Modal -->
<div class="modal fade" id="addCommunityModal" tabindex="-1" aria-labelledby="addCommunityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-light" style="background: linear-gradient(135deg, #222 30%, #111 100%); border: none;">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="addCommunityModalLabel">🧩 Formulario para agregar Comunidad</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <h4 class="fw-bold">🌟 Potenciá tu Comunidad</h4>
        <p>
          Al unirte a <span class="fw-bold text-warning">4evergaming</span>, aumentás tu exposición y obtenés mayor reconocimiento. Unite y maximizá tu potencial.
        </p>

        @guest
        <div class="alert alert-danger small py-2 text-dark">
          Antes de poder registrar tu Comunidad, es necesario que
          <a href="{{ route('login') }}" class="text-dark fw-semibold text-decoration-underline">inicies sesión</a>.
        </div>
        @endguest

        <form enctype="multipart/form-data" id="communityForm">
          @csrf

          <div class="form-group mb-3">
            <label for="name" class="fw-semibold text-light">Nombre de la Comunidad</label>
            <input type="text" class="form-control bg-dark text-light border-secondary" name="name" id="name" required @guest disabled @endguest>
            <small class="form-text text-light opacity-75">El nombre de tu Comunidad tal como la reconocen en el juego.</small>
          </div>

          <div class="form-group mb-3">
            <label for="description" class="fw-semibold text-light">Descripción</label>
            <textarea class="form-control bg-dark text-light border-secondary" name="description" id="description" style="height: 100px;" @guest disabled @endguest></textarea>
            <small class="form-text text-light opacity-75">Una breve descripción de cómo las personas conocen tu comunidad.</small>
          </div>

          <div class="form-group mb-3">
            <label for="logo" class="fw-semibold text-light">Logo</label>
            <input type="file" class="form-control bg-dark text-light border-secondary custom-file-input" name="logo" id="logo" @guest disabled @endguest>
            <small class="form-text text-light opacity-75">Subí el logo que identifica tu Comunidad. Una mala calidad puede reducir tu calificación.</small>
          </div>

          <input type="submit" class="d-none" id="communityFormSubmitButton">
        </form>


        <div class="mt-3" id="responseCommunity"></div>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-danger @guest disabled @endguest" id="saveCommunityButton" onclick="saveCommunity()">Guardar</button>
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>