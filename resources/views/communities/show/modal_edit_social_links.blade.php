<div class="modal fade" id="editSocialModal" tabindex="-1" aria-labelledby="editSocialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSocialModalLabel">Editar Redes Sociales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $community->whatsapp }}">
                            </div>
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $community->instagram }}">
                            </div>
                            <div class="mb-3">
                                <label for="tiktok" class="form-label">TikTok</label>
                                <input type="text" class="form-control" id="tiktok" name="tiktok" value="{{ $community->tiktok }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="youtube" class="form-label">YouTube</label>
                                <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $community->youtube }}">
                            </div>
                            <div class="mb-3">
                                <label for="discord" class="form-label">Discord</label>
                                <input type="text" class="form-control" id="discord" name="discord" value="{{ $community->discord }}">
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Sitio Web</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{ $community->website }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
