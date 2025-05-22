<div class="modal fade" id="modalServicios" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formServicio" name="formServicio" class="form-horizontal">
                    <input type="hidden" id="idServicio" name="idServicio">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtNumSerie">Número de Serie</label>
                            <input type="text" class="form-control" id="txtNumSerie" name="txtNumSerie" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="listCliente">Cliente</label>
                            <select class="form-control" id="listCliente" name="listCliente" required>
                                <option value="" selected disabled>Seleccionar</option>
                                <?php foreach ($data['clientes'] as $cliente) { ?>
                                    <option value="<?= $cliente['idcliente'] ?>"><?= $cliente['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripción del Equipo</label>
                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" required></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listEstado">Estado de Reparación</label>
                            <select class="form-control" id="listEstado" name="listEstado" required>
                                <option value="" selected disabled>Seleccionar</option>
                                <?php foreach ($data['estados'] as $estado) { ?>
                                    <option value="<?= $estado['idestado'] ?>"><?= $estado['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDiagnostico">Diagnóstico</label>
                        <textarea class="form-control" id="txtDiagnostico" name="txtDiagnostico" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtObservaciones">Observaciones</label>
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>