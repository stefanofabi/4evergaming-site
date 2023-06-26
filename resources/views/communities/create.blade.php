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
            },
            success: function(msg){
                $('#responseCommunity').html('<span style="font-size:18px;color:#34A853"> Tu Comunidad fue agregada con éxito. Gracias por ser parte! </span>');
                $('#communityForm').css("opacity","");
                $("#saveCommunityButton").removeClass("disabled");
            }
          });
  });
</script>


<script>
  function saveCommunity() 
  {
    $('#saveCommunityButton').click();
  }
</script>
@append

<!-- Modal -->
<div class="modal fade" id="addCommunityModal" tabindex="-1" aria-labelledby="addCommunityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCommunityModalLabel"> Formulario para agregar Comunidad </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <h4 class="fw-bold"> Potenciá tu Comunidad y alcanzá el reconocimiento que merecés en línea </h4>
        <p> 
          Al unirte a <span class="fw-bold">4evergaming</span>, podrás aumentar tu exposición y obtener un mayor reconocimiento en Internet al agregar tu comunidad. Unite a nosotros y maximizá el potencial de tu Comunidad.
        </p>

        @guest
        <div class="text-danger"> Antes de poder registrar tu Comunidad, es necesario que <a href="{{ route('login') }}"> inicies sesión </a> </div> 
        @endguest

        <div class="row">
          <form enctype="multipart/form-data" id="communityForm">
            @csrf

            <div class="form-group col-md-9">
                  <label for="name" class="fw-bold"> Nombre de la Comunidad </label>
                  <input type="text" class="form-control" name="name" id="name" value="" aria-describedby="nameHelp" required @guest disabled @endguest>

                  <small id="nameHelp" class="form-text text-muted"> El nombre de tu Comunidad tal como la reconocen en el juego </small>
            </div>

            <div class="form-group mt-2 col-md-9">
                  <label for="name" class="fw-bold"> Página web / Discord / Redes Sociales / Grupo WhatsApp / Etc. </label>
                  <input type="url" class="form-control" name="contact_url" id="contact_url" value="" aria-describedby="websiteHelp" required @guest disabled @endguest>

                  <small id="websiteHelp" class="form-text text-muted"> Dejanos un enlace para invitar a futuros jugadores a unirse a tu Comunidad </small>
            </div>

            <div class="form-group mt-2 col-md-9">
                  <label for="name" class="fw-bold"> Logo </label>
                  <input type="file" class="form-control" name="logo" id="logo" value="" aria-describedby="logoHelp" required @guest disabled @endguest>

                  <small id="logoHelp" class="form-text text-muted"> Subí el logo que identifica tu Comunidad. Una mala calidad puede reducir tu calificación. </small>
            </div>

            <input type="submit" class="d-none" id="saveCommunityButton">
          </form>
        </div>

        <div class="mt-3" id="responseCommunity"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-primary @guest disabled @endguest" onclick="saveCommunity()"> Guardar </button>
      </div>
    </div>
  </div>
</div>