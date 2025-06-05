<div class="modal fade" id="modalFormDistribuidor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Distribuidor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formDistribuidor" name="formDistribuidor" class="form-horizontal">
          <input type="hidden" id="idDistribuidor" name="idDistribuidor" value="">
          <input type="hidden" id="status" name="status" value="1">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
          <div class="form-group">
            <label class="control-label">Nombre <span class="required">*</span></label>
            <input class="form-control" id="txtNombreDist" name="txtNombre" type="text" required>
          </div>
          <div class="form-group">
            <label class="control-label">RIF <span class="required">*</span></label>
            <input class="form-control" id="txtRIFDist" name="txtRIF" type="text" required>
          </div>
          <div class="form-group">
            <label class="control-label">Teléfono <span class="required">*</span></label>
            <input class="form-control" id="txtTelefonoDist" name="txtTelefono" type="text" required>
          </div>
          <div class="form-group">
            <label class="control-label">Dirección <span class="required">*</span></label>
            <textarea class="form-control" id="txtDireccionDist" name="txtDireccion" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para consulta de distribuidores -->
<div class="modal fade" id="modalConsultaDistribuidores" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerPrimary">
        <h5 class="modal-title" id="titleModal">Consulta de Distribuidores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="tableDistribuidores">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>RIF</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha Creación</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí se llenarán los datos dinámicamente con JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
