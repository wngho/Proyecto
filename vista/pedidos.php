<!-- Landing page 
"esta es la pagina principal del proyecto, cuando se entra primera vez 
y cuando no haya sesion iniciada esta sera la primera vista a mostrar"
Info: solo es una vista de bienvenida, acceso a la login a traves de sus referencias
Estado: medio (falta añadir detalles para que este terminada) 
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos!</title>
    <?php require_once("common/linkcss.php"); ?>
</head>
<body>
    <header>
    <?php require_once("common/menu.php"); ?>
    </header>
    <!-- Sección de bienvenida -->
      <main class="container-fluid mt-3 ">
        <section class="row">
        <?php require_once "common/aside.php";?>
          <article class="col-lg-8 ms-4">
            <header class="mt-3 display-6">
              <span class="fw-bold text-decoration-underline text-warning">Pedidos</span>
            </header>
            <div class="mt-3 d-flex justify-content-end">
              <button type="button"class="btn btn-primary btn-sm py-1 px-2" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="bi bi-plus-circle me-2"></i><small>Agregar Nueva Orden</small></button>
            </div>
            <table class="table table-sm table-striped table-bordered table-responsive mb-5 mt-2 w-100 rounded">
              <thead class="text-center align-middle">
                <tr>
                  <th class="rounded-start-5" scope="col">#</th>
                  <th scope="col">Pedido</th>
                  <th scope="col">Nombre del Clientes</th>
                  <th scope="col" class="text-warp">Cantidad de </br>productos</th>
                  <th scope="col" class="text-warp">Fecha de registro</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Accion</th>
                </tr>
              </thead>
              <tbody class="text-center align-middle">
                <tr class="">
                  <th scope="row">1</th>
                  <td>00000001</td>
                  <td>Juan Jimenez</td>
                  <td>5</td>
                  
                  <td>10/01/25</td>
                  <td>
                  <div class="item bg-success mx-2 my-2 border border-1 shadow border-success rounded-5 px-2 py-1">
                    <span class="text-light display-6 fs-5 mx-1 py-2" ><i class="bi bi-truck me-2"></i>Enviado</span>
                  </div>              

                  </td>
                  <td class="justify-content-center h-auto">
                    <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="bi bi-pencil-square "></i></button>
                    <button class="btn btn-danger py-1 px-2 mx-2 fs-6"><i class="bi bi-trash"></i></button>
                    <button class="btn btn-info py-1 px-2 fs-6"><i class="bi bi-search"></i></button>
                  </td>
                </tr>
                <tr class="">
                  <th scope="row">2</th>
                  <td>245211321</td>
                  <td>Juan Jimenez</td>
                  <td>Pc de Escritorio</td>
                  
                  <td>10/01/25</td>
                  <td>
                    <div class="item bg-info mx-2 my-2 border border-1 border-info shadow rounded-5 px-2 py-1">
                        <span class="text-dark display-6 fs-5 mx-2 py-2" ><i class="bi bi-clipboard-check"></i>   Realizando Pedido</span>
                    </div>              
                  </td>
                  <td class="justify-content-center h-auto">
                    <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="bi bi-pencil-square "></i></button>
                    <button class="btn btn-danger py-1 px-2 mx-2 fs-6"><i class="bi bi-trash"></i></button>
                    <button class="btn btn-info py-1 px-2 fs-6"><i class="bi bi-search"></i></button>
                  </td>
                </tr>
                <tr class="">
                  <th scope="row">3</th>
                  <td>245211321</td>
                  <td>Juan Jimenez</td>
                  <td>Pc de Escritorio</td>
                  
                  <td>10/01/25</td>
                  <td>
                    <div class="item bg-warning mx-2 my-2 border border-1 border-warning shadow rounded-5 px-2 py-1">
                      <span class="text-dark display-6 fs-5 mx-2 py-2 " ><i class="bi bi-info-circle-fill me-2"></i>Nuevo Pedido</span>
                    </div>              
                  </td>
                  <td class="justify-content-center h-auto">
                    <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="bi bi-pencil-square "></i></button>
                    <button class="btn btn-danger py-1 px-2 mx-2 fs-6"><i class="bi bi-trash"></i></button>
                    <button class="btn btn-info py-1 px-2 fs-6"><i class="bi bi-search"></i></button>
                  </td>
                </tr>
                <tr class="">
                  <th scope="row">4</th>
                  <td>245211321</td>
                  <td>Juan Jimenez</td>
                  <td>Pc de Escritorio</td>
                  
                  <td>10/01/25</td>
                  <td>
                    <div class="item bg-danger mx-2 my-2 border border-1 border-warning shadow rounded-5 px-2 py-1">
                        <span class="text-light display-6 fs-5 mx-2 py-2" ><i class="bi bi-x-circle-fill me-2"></i>No realizado</span>
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
          </article>
        </section>
      </main>

      <!-- Modal Universal para el producto -->
      <div class="modal" id="agregarProductoModal"tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Agregar Producto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <header>
                  <span class="display-6 fs-5">Agregar Producto</span>
                </header>
                <div class="col-lg-6"></div>
                <div class="col-lg-6"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    <footer>
    <?php require_once("common/footer.php"); ?>
    </footer>
    
    <script src="js/graficos.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/categoria.js"></script>
    <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    
    
</body>
</html>   