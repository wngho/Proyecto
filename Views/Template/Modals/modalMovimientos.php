<div class="modal fade" id="modalMovimientos" tabindex="-1" aria-labelledby="modalMovimientosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMovimientosLabel">Registrar Movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formMovimiento" name="formMovimiento">
                <div class="modal-body">
                    <input type="hidden" id="idServicioMov" name="idServicio">
                    <div class="form-group">
                        <label for="listEstadoNuevo">Nuevo Estado <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="listEstadoNuevo" name="listEstadoNuevo" required>
                            <option value="" selected disabled>Seleccionar...</option>
                            <?php foreach($data['estados'] as $estado) { ?>
                                <option value="<?= $estado['idestado'] ?>" data-color="<?= $estado['color'] ?>">
                                    <?= $estado['nombre'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtDescMovimiento">Descripción del Movimiento <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="txtDescMovimiento" name="txtDescMovimiento" rows="3" required></textarea>
                    </div>
                    <hr>
                    <div id="containerMovimientos">
                        <!-- Aquí se cargará el historial de movimientos -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
                </div>
            </form>
        </div>
    </div>
</div>