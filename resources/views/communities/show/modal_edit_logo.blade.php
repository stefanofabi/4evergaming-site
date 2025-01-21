<div class="modal fade" id="editLogoModal" tabindex="-1" aria-labelledby="editLogoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLogoModalLabel">Editar Logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="logo" class="form-label">Nuevo Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo">
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
