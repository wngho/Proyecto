<div class="modal fade" id="modalFotos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fotos del Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formFoto" name="formFoto" enctype="multipart/form-data">
                    <input type="hidden" id="idServicioFoto" name="idServicioFoto">
                    <div class="form-group">
                        <label for="foto">Seleccionar Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="txtDescFoto">Descripción (Opcional)</label>
                        <input type="text" class="form-control" id="txtDescFoto" name="txtDescFoto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Subir Foto</button>
                    </div>
                </form>
                <hr>
                <div class="row" id="containerFotos">
                    <!-- Aquí se cargarán las fotos existentes via AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>