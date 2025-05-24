<div class="modal fade" id="modalFormCompras" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCompras" name="formCompras" class="form-horizontal">
          <input type="hidden" id="idCompras" name="idCompras" value="">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

          <!-- Datos del Distribuidor -->
          <h5 class="mt-3">Datos del Distribuidor</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">RIF/Distribuidor <span class="required">*</span></label>
                <input class="form-control" id="txtRIF" name="txtRIF" type="text" required>
              </div>
              <div class="form-group">
                <label class="control-label">Nombre Distribuidor <span class="required">*</span></label>
                <input class="form-control" id="txtNombreDistribuidor" name="txtNombreDistribuidor" type="text" required>
              </div>
              <div class="form-group">
                <label class="control-label">Dirección <span class="required">*</span></label>
                <input class="form-control" id="txtDireccion" name="txtDireccion" type="text" required>
              </div>
              <div class="form-group">
                <label class="control-label">Teléfono <span class="required">*</span></label>
                <input class="form-control" id="txtTelefono" name="txtTelefono" type="text" required>
              </div>
              <div class="form-group">
                <label class="control-label">Email <span class="required">*</span></label>
                <input class="form-control" id="txtEmail" name="txtEmail" type="email" required>
              </div>
              <div class="form-group">
                <label class="control-label">Fecha Registro <span class="required">*</span></label>
                <input class="form-control" id="txtFechaRegistro" name="txtFechaRegistro" type="date" required>
              </div>
            </div>
          </div>

          <!-- Datos del Producto -->
          <h5 class="mt-4">Datos del Producto</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Código <span class="required">*</span></label>
                <input class="form-control" id="txtCodigo" name="txtCodigo" type="text" placeholder="Código de barra" required>
                <div id="divBarCode" class="text-center mt-2">
                  <div id="printCode">
                    <svg id="barcode"></svg>
                  </div>
                  <button class="btn btn-success btn-sm" type="button" onClick="fntPrintBarcode('#printCode')"><i class="fas fa-print"></i> Imprimir</button>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Nombre del Producto <span class="required">*</span></label>
                <input class="form-control" id="txtNombreProducto" name="txtNombreProducto" type="text" required>
              </div>
              <div class="form-group">
                <label class="control-label">Precio <span class="required">*</span></label>
                <input class="form-control" id="txtPrecio" name="txtPrecio" type="text" required>
              </div>
              <div class="form-group">
                <label class="control-label">Cantidad <span class="required">*</span></label>
                <input class="form-control" id="txtCantidad" name="txtCantidad" type="number" required onchange="checkSerials()">
              </div>
              <div class="form-group">
                <label class="control-label">¿Producto tiene Serial?</label>
                <input type="checkbox" id="chkSerial" onchange="toggleSerialInputs()">
              </div>
              <div id="serialInputs" style="display: none;">
                <label class="control-label">Seriales</label>
                <div id="serialContainer"></div>
              </div>
              <div class="form-group">
                <label class="control-label">Fecha Creación <span class="required">*</span></label>
                <input class="form-control" id="txtFechaCreacion" name="txtFechaCreacion" type="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="listCategoria">Categoría <span class="required">*</span></label>
                <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" required></select>
              </div>
              <div class="form-group">
                <label for="listStatus">Estado <span class="required">*</span></label>
                <select class="form-control selectpicker" id="listStatus" name="listStatus" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Descripción</label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit">
                <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span>
              </button>
            </div>
            <div class="form-group col-md-6">
              <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal">
                <i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar
              </button>
            </div>
          </div>

          <div class="tile-footer">
            <div class="form-group col-md-12">
              <div id="containerGallery">
                <span>Agregar foto (440 x 545)</span>
                <button class="btnAddImage btn btn-info btn-sm" type="button">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <hr>
              <div id="containerImages"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleSerialInputs() {
    const chkSerial = document.getElementById('chkSerial').checked;
    const serialContainer = document.getElementById('serialContainer');
    serialContainer.innerHTML = '';
    document.getElementById('serialInputs').style.display = chkSerial ? 'block' : 'none';
    
    if (chkSerial) {
      const cantidad = document.getElementById('txtCantidad').value;
      for (let i = 1; i <= cantidad; i++) {
        const serialInput = document.createElement('input');
        serialInput.type = 'text';
        serialInput.placeholder = `Serial ${i}`;
        serialInput.className = 'form-control mb-2';
        serialContainer.appendChild(serialInput);
      }
    }
  }

  function checkSerials() {
    if (document.getElementById('chkSerial').checked) {
      toggleSerialInputs();
    }
  }
</script>

<!-- Asegúrate de incluir los scripts de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>