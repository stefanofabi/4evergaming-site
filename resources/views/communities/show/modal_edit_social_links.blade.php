@section('css')
<style>
  .modal-content input::placeholder,
  .modal-content textarea::placeholder {
    color: #ccc !important;
    opacity: 1 !important;
  }
</style>
@append

<div class="modal fade" id="editSocialModal" tabindex="-1" aria-labelledby="editSocialModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="editSocialModalLabel">Editar Redes Sociales</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div id="responseCommunitySocialLink"></div>

        <form method="POST" action="" id="communitySocialLinkForm">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="whatsapp" class="form-label fw-bold">WhatsApp</label>
                <input type="text" class="form-control bg-dark text-light border-secondary" id="whatsapp" name="whatsapp" value="{{ $community->whatsapp }}" placeholder="URL de WhatsApp">
              </div>

              <div class="mb-3">
                <label for="instagram" class="form-label fw-bold">Instagram</label>
                <input type="text" class="form-control bg-dark text-light border-secondary" id="instagram" name="instagram" value="{{ $community->instagram }}" placeholder="Usuario de Instagram">
              </div>

              <div class="mb-3">
                <label for="tiktok" class="form-label fw-bold">TikTok</label>
                <input type="text" class="form-control bg-dark text-light border-secondary" id="tiktok" name="tiktok" value="{{ $community->tiktok }}" placeholder="Usuario de Tiktok sin @">
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="youtube" class="form-label fw-bold">YouTube</label>
                <input type="text" class="form-control bg-dark text-light border-secondary" id="youtube" name="youtube" value="{{ $community->youtube }}" placeholder="Usuario de YouTube sin @">
              </div>

              <div class="mb-3">
                <label for="discord" class="form-label fw-bold">Discord</label>
                <input type="text" class="form-control bg-dark text-light border-secondary" id="discord" name="discord" value="{{ $community->discord }}" placeholder="ID Canal Discord">
              </div>

              <div class="mb-3">
                <label for="website" class="form-label fw-bold">Sitio Web</label>
                <input type="text" class="form-control bg-dark text-light border-secondary" id="website" name="website" value="{{ $community->website }}" placeholder="URL con HTTP">
              </div>
            </div>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-danger text-light border-light" id="saveCommunitySocialLinkButton">Guardar Cambios</button>
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
