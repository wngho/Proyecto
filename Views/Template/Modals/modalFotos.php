<div class="modal fade" id="modalFotos" tabindex="-1" aria-labelledby="modalFotosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFotosLabel">Gestión de Fotos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formFoto" name="formFoto" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idServicioFoto" name="idServicioFoto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Seleccionar Foto <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" required>
                                <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtDescFoto">Descripción (Opcional)</label>
                                <input type="text" class="form-control" id="txtDescFoto" name="txtDescFoto" placeholder="Breve descripción de la foto">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="containerFotos">
                        <!-- Aquí se cargarán las fotos existentes -->
                        <div class="col-12">
                            <div class="alert alert-info">Cargando fotos...</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Subir Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>