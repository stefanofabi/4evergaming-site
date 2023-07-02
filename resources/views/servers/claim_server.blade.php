@section('javascript')
<script type="module">
  $("#claimServerForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('servers/claim_server') }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function(){
                $('#claimServerButton').addClass("disabled");
                $('#claimServerForm').css("opacity",".5");
                $('#responseClaimServer').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseClaimServer').html('<span style="font-size:18px;color:#34A853"> '+ response.message +'  </span>');
            $('#claimServerForm').css("opacity","");
            $("#claimServerButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseClaimServer').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#claimServerForm').css("opacity","");
            $("#claimServerButton").removeClass("disabled");
          });
  });
</script>

<script>
  function claimServer() 
  {
    $('#claimServerSubmit').click();
  }
</script>
@append

<!-- Modal -->
<div class="modal fade" id="claimServerModal" tabindex="-1" aria-labelledby="claimServerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="claimServerModalLabel"> Formulario para reclamar servidor </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <h4 class="fw-bold"> Reclamo de propiedad </h4>
        <p> 
          No te preocupes, estamos aquí para ayudarte a recuperar tu servidor y que estés tranquilo. Confía en nosotros para resolver este problema.
        </p>

        @guest
        <div class="text-danger"> Antes de poder reclamar tu servidor, es necesario que <a href="{{ route('login') }}"> inicies sesión </a> </div> 
        @endguest

        @if (auth()->user() && is_null(auth()->user()->community))
        <div class="text-danger"> Antes de poder reclamar tu servidor, es necesario que registres tu comunidad en la plataforma </div> 
        @endguest

        <p> Antes de reclamar tu servidor es necesario que coloques como nombre de servidor lo siguiente: <strong> GameTrackerClaimServer </strong> </p>

        <div class="row">
          <form method="post" id="claimServerForm">
            @csrf

            <div class="col-md-9">
              <div class="input-group">
                <input type="text" class="form-control" name="ip" value="{{ $server->ip}}" placeholder="IP" aria-label="IP">
                <span class="input-group-text">:</span>
                <input type="number" class="form-control" name="port" value="{{ $server->port }}" placeholder="Puerto" aria-label="Puerto" min="0" max="65535">
              </div>
            </div>

            <input type="submit" class="d-none" id="claimServerSubmit">
          </form>
        </div>

        <div class="mt-3" id="responseClaimServer"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-danger @guest disabled @endguest" id="claimServerButton" onclick="claimServer()"> Reclamar </button>
      </div>
    </div>
  </div>
</div>