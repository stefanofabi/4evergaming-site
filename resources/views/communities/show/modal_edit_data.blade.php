<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Editar Datos de la Comunidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $community->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control form-control-lg" id="description" name="description" rows="5">{{ $community->description }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                     </div>
                </form>
            </div>
        </div>
    </div>
</div>