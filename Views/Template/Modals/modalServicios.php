<?php
// Modal para crear/editar servicio técnico
?>
<div class="modal fade" id="modalServicioTecnico" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formServicio" name="formServicio">
                    <input type="hidden" id="idServicio" name="idServicio">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNumSerie">Número de Serie</label>
                                <input type="text" class="form-control" id="txtNumSerie" name="txtNumSerie" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="listCliente">Cliente</label>
                                <select class="form-control selectpicker" id="listCliente" name="listCliente" required data-live-search="true">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="listEstado">Estado</label>
                                <select class="form-control selectpicker" id="listEstado" name="listEstado" required>
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripción del Equipo/Problema</label>
                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtDiagnostico">Diagnóstico Inicial</label>
                        <textarea class="form-control" id="txtDiagnostico" name="txtDiagnostico" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtObservaciones">Observaciones</label>
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="2"></textarea>
                    </div>
                    <div class="form-group notblock" id="containerGallery">
                        <label>Fotos del Equipo</label>
                        <div class="d-flex flex-wrap gap-2 mb-2" id="containerImages"></div>
                        <button type="button" class="btn btn-sm btnAddImage"><i class="fas fa-plus-circle"></i> Agregar Foto</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnActionForm"><span id="btnText">Guardar</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para historial -->
<div class="modal fade" id="modalViewServicio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title">Historial del Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNumSerie">Número de Serie</label>
                                <input type="text" class="form-control" id="txt" name="txtNumSerie" required>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNumSerie">Nombre</label>
                                <input type="text" class="form-control" id="listCliente" name="txtNumSerie" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                                <label for="txtNumSerie">Telefono</label>
                                <input type="text" class="form-control" id="txtEmail" name="txtNumSerie" required>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNumSerie">Email</label>
                                <input type="text" class="form-control" id="txtTelefono" name="txtNumSerie" required>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNumSerie">Estado</label>
                                <input type="text" class="form-control" id="listEstado" name="txtNumSerie" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNumSerie">Fecha de Entrada</label>
                                <input type="text" class="form-control" id="txtFechaEntrada" name="txtNumSerie" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNumSerie">Fecha de Salida</label>
                                <input type="text" class="form-control" id="txtFechaSalida" name="txtNumSerie" required>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripción del Equipo/Problema</label>
                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtDiagnostico">Diagnóstico Inicial</label>
                        <textarea class="form-control" id="txtDiagnostico" name="txtDiagnostico" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtObservaciones">Observaciones</label>
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="2"></textarea>
                    </div>
                    <div class="form-group notblock" id="containerGallery">
                        <label>Fotos del Equipo</label>
                        <div class="d-flex flex-wrap gap-2 mb-2" id="containerImages"></div>
                        <button type="button" class="btn btn-sm btnAddImage"><i class="fas fa-plus-circle"></i> Agregar Foto</button>
                    </div>
                    <div class="form-group notblock" id="containerGallery">
                        <label>Fotos del Equipo</label>
                        <div class="d-flex flex-wrap gap-2 mb-2" id="containerImages"></div>
                        <div id="celFotos"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar movimiento -->
<div class="modal fade" id="modalAddMovimiento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title">Agregar Movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formMovimiento" name="formMovimiento">
                <div class="modal-body">
                    <input type="hidden" id="idServicioMov" name="idservicio">
                    <div class="form-group">
                        <label for="listEstadoNuevo">Nuevo Estado</label>
                        <select class="form-control" id="listEstadoNuevo" name="idestado_nuevo" required>
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripción</label>
                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="saveMovimiento()"><span id="btnText">Guardar</span></button>
                </div>
            </form>
        </div>
    </div>
</div>