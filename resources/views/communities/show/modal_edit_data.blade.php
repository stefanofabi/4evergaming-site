<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="editDataModalLabel">Editar Datos de la Comunidad</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div id="responseCommunityData"></div>

        <form method="POST" action="" id="communityDataForm">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nombre</label>
            <input type="text" class="form-control bg-dark text-light border-secondary" id="name" name="name" value="{{ $community->name }}" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label fw-bold">Descripción</label>
            <textarea class="form-control form-control-lg bg-dark text-light border-secondary" id="description" name="description" rows="5">{{ $community->description }}</textarea>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-danger text-light border-light" id="saveCommunityDataButton">Guardar Cambios</button>
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
