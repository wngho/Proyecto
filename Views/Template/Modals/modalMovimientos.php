<div class="modal fade" id="modalMovimientos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial de Movimientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formMovimiento" name="formMovimiento">
                    <input type="hidden" id="idServicioMov" name="idServicioMov">
                    <div class="form-group">
                        <label for="listEstadoNuevo">Nuevo Estado</label>
                        <select class="form-control" id="listEstadoNuevo" name="listEstadoNuevo" required>
                            <option value="" selected disabled>Seleccionar</option>
                            <?php foreach ($data['estados'] as $estado) { ?>
                                <option value="<?= $estado['idestado'] ?>"><?= $estado['nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtDescMovimiento">Descripción del Movimiento</label>
                        <textarea class="form-control" id="txtDescMovimiento" name="txtDescMovimiento" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
                    </div>
                </form>
                <hr>
                <div id="containerMovimientos">
                    <!-- Aquí se cargarán los movimientos existentes via AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>