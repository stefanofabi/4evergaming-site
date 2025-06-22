<div class="modal fade" id="editLogoModal" tabindex="-1" aria-labelledby="editLogoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="editLogoModalLabel">Editar Logo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div id="responseCommunityLogo"></div>

        <form method="POST" action="" enctype="multipart/form-data" id="communityLogoForm">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="logo" class="form-label fw-bold">Nuevo Logo</label>
            <input type="file" class="form-control bg-dark text-light border-secondary" id="logo" name="logo">
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-danger text-light" id="saveCommunityLogoButton">Guardar Cambios</button>
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>