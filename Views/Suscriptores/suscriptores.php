<?php 
    headerAdmin($data); 
?>
  <main class="app-content">    
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/suscriptores"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableSuscriptores">
                      <thead>
                        <tr>
                        <th class="rounded-start-5" scope="col">#</th>
                  <th scope="col">Codigo</th>
                  <th scope="col">Nombre del Clientes</th>
                  <th scope="col">Tipo de equipo</th>
                  <th scope="col" class="text-warp">Fecha de ingreso</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr class="">
                  <th scope="row">1</th>
                  <td>245211321</td>
                  <td>Juan Jimenez</td>
                  <td>Laptop</td>
                  
                  <td>10/01/25</td>
                  <td>
                  <div class="item bg-success mx-2 my-2 border border-1 shadow border-success rounded-5 px-2 py-1">
                    <span class="text-light display-6 fs-5 mx-1 py-2" ><i class="bi bi-check2-circle"></i>   Listo</span>
                  </div>              

                  </td>
                  <td class="justify-content-center h-auto">
                    <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="bi bi-pencil-square "></i></button>
                    <button class="btn btn-danger py-1 px-2 mx-2 fs-6"><i class="bi bi-trash"></i></button>
                    <button class="btn btn-info py-1 px-2 fs-6"><i class="bi bi-search"></i></button>
                  </td>
                </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    