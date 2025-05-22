<?php 
    headerAdmin($data); 
    getModal('modalProductos',$data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-safari"></i> <?= $data['page_title'] ?>
              
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/productos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Usuario</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01">
                  <option selected>Seleccione un Usuario</option>
                  
                  <!-- Buscar los usuarios -->

                </select>
              </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableProductos">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Usuario</th>
                          <th>Accion</th>
                          <th>Modulo</th>
                          <th>Detalles</th>
                          <th>Fecha</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    