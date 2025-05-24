<div class="modal fade" id="modalServicios" tabindex="-1" aria-labelledby="modalServiciosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalServiciosLabel">Nuevo Servicio Técnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formServicio" name="formServicio">
                <div class="modal-body">
                    <input type="hidden" id="idServicio" name="idServicio">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="listCliente">Cliente <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="listCliente" name="listCliente" required>
                                <option value="" selected disabled>Seleccionar...</option>
                                <?php foreach($data['clientes'] as $cliente) { ?>
                                    <option value="<?= $cliente['idpersona'] ?>">
                                        <?= $cliente['nombres'].' '.$cliente['apellidos'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtNumSerie">Número de Serie <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtNumSerie" name="txtNumSerie" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripción del Equipo <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" required></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="listEstado">Estado <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="listEstado" name="listEstado" required>
                                <option value="" selected disabled>Seleccionar...</option>
                                <?php foreach($data['estados'] as $estado) { ?>
                                    <option value="<?= $estado['idestado'] ?>" data-color="<?= $estado['color'] ?>">
                                        <?= $estado['nombre'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtFechaEntrada">Fecha de Entrada</label>
                            <input type="text" class="form-control" id="txtFechaEntrada" name="txtFechaEntrada" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDiagnostico">Diagnóstico Inicial</label>
                        <textarea class="form-control" id="txtDiagnostico" name="txtDiagnostico" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtObservaciones">Observaciones</label>
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>