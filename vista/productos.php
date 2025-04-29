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
    <title>Dashboard!</title>
    <?php require_once("common/linkcss.php"); ?>
    <link rel="stylesheet" href="css/quill.snow.css">
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
              <span class="fw-bold text-decoration-underline text-warning">Productos</span>
            </header>
            <ul class="nav nav-pills mt-4" id="pills-tab" role="tablist">
              <li class="nav-item me-3" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Ultimos Agregados</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Publicados</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">

                <div class="mt-3 d-flex justify-content-end">
                  <button type="button"class="btn btn-primary btn-sm py-1 px-2" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="bi bi-plus-circle me-2"></i><small>Agregar Producto</small></button>
                </div>
                <table class="table table-sm table-striped table-bordered table-responsive mb-5 mt-2 w-100 rounded">
                  <thead class="text-center align-middle">
                    <tr>
                      <th class="rounded-start-5" scope="col">#</th>
                      <th scope="col">Codigo</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Cantidad Disponible</th>
                      <th scope="col">Cantidad Vendida</th>
                      <th scope="col">Fecha de ingreso</th>
                      <th scope="col">Accion</th>
                    </tr>
                  </thead>
                  <tbody class="text-center align-middle">
                    <tr class="table-success">
                      <th scope="row">1</th>
                      <td>245211321</td>
                      <td>Pendrive 128Gb</td>
                      <td>30</td>
                      <td>15</td>
                      <td>10/01/25</td>
                      <td class="d-flex border-0 justify-content-center">
                        <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"><i class="bi bi-pencil-square "></i></button>
                        <button class="btn btn-danger py-1 px-2 mx-2 fs-6"><i class="bi bi-trash"></i></button>
                        <button class="btn btn-info py-1 px-2 fs-6"><i class="bi bi-search"></i></button>
                      </td>
                    </tr>
                    <tr class="table-danger">
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                      <td>@fat</td>
                      <td>@fat</td>
                      <td>@fat</td>
                    </tr>
                    <tr class="table-secondary">
                      <th scope="row">3</th>
                      <td>John</td>
                      <td>John</td>
                      <td>John</td>
                      <td>John</td>
                      <td>Doe</td>
                      <td>@social</td>
                    </tr>
                  </tbody>
                </table>



              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

                <table class="table table-sm table-striped table-bordered table-responsive mb-5 mt-2 w-100 rounded">
                  <thead class="text-center align-middle">
                    <tr>
                      <th class="rounded-start-5" scope="col">#</th>
                      <th scope="col">Codigo</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Publicado</th>
                      
                      <th scope="col">Precio</th>
                      <th scope="col">Accion</th>
                    </tr>
                  </thead>
                  <tbody class="text-center align-middle">
                    <tr class="">
                      <th scope="row">1</th>
                      <td>245211321</td>
                      <td>Pendrive 128Gb</td>
                      <td class="bg-danger text-light fw-bold">No Publicado</td>
                      <td>15 $</td>
                      <td class="d-flex border-0 justify-content-center">
                        <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#publicarProductoModal"><i class="bi bi-pencil-square "></i></button>
                      </td>
                    </tr>
                    <tr class="">
                      <th scope="row">2</th>
                      <td>23141512</td>
                      <td>Pendrive 64GB</td>
                      <td class="bg-success text-light fw-bold">Publicado</td>
                      <td>12 $</td>
                      <td class="d-flex border-0 justify-content-center">
                        <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#publicarProductoModal"><i class="bi bi-pencil-square "></i></button>
                      </td>
                    </tr>
                    <tr class="">
                      <th scope="row">3</th>
                      <td>21515314231</td>
                      <td>Pendrive 16gb</td>
                      <td class="bg-info text-light fw-bold">Pausado</td>
                      <td>10$</td>
                      <td class="d-flex border-0 justify-content-center">
                        <button class="btn btn-sm py-1 px-2 btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#publicarProductoModal"><i class="bi bi-pencil-square "></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
            </div>
            
          </article>
        </section>
      </main>
      <div class="modal" id="agregarProductoModal"tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Agregar Producto</h5>
              <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
              <div class="modal-body">
                <div class="row">
                  <header class="border-bottom border-2 border-secondary-subtle pb-2">
                    <span class="display-6 fs-3 fw-medium">Datos del Producto</span>
                  </header>
                  <div class="col-lg-6">
                    <div class="my-3">
                      <label for="EtiquetaCodigo" class="form-label">Codigo</label>
                      <input type="text" class="form-control" id="inputCodigo" placeholder="Codigo">
                    </div>
                    <div class="my-3">
                      <label for="EtiquetaNombre" class="form-label">Nombre del Equipo</label>
                      <input type="text" class="form-control" id="inputCodigo" placeholder="Nombre del producto">
                    </div>
                    <div class="my-3">
                      <label for="EtiquetaNombre" class="form-label">Modelo del Equipo</label>
                      <input type="text" class="form-control" id="inputCodigo" placeholder="Modelo del Equipo">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="my-3">
                      <label for="EtiquetaNombre" class="form-label">Marca del Equipo</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="my-3">
                      <label for="EtiquetaNombre" class="form-label">Categoria</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="my-3">
                      <label for="EtiquetaNombre" class="form-label">Subcategoria</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <input type="reset" class="btn btn-warning" value="Limpiar">
                  <input type="submit" class="btn btn-success" value="Enviar">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal" id="publicarProductoModal"tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Publicar Producto</h5>
              <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
              <div class="modal-body">
                <div class="row">
                  <header class="border-bottom border-2 border-secondary-subtle pb-2">
                    <span class="display-6 fs-5 fw-medium">Datos del Producto</span>
                  </header>
                  <div class="col-lg-6 mt-3">
                    <div class="row mb-3">
                      <label for="EtiquetaCodigo" class="col-sm-2 col-form-label">Codigo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="Codigo" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">Nombre </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="Nombre del producto" disabled>
                      </div>
                    </div>
                    <div class="row my-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">Modelo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="Modelo del Equipo" disabled>
                      </div>
                    </div>
                  </div>
                    
                  <div class="col-lg-6 mt-3">
                  <div class="row mb-3">
                      <label for="EtiquetaCodigo" class="col-sm-2 col-form-label">Marca</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="Marca" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">Categoria </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="Categoria" disabled >
                      </div>
                    </div>
                    <div class="row my-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">SubCategoria</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="SubCategoria" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <header class="border-bottom border-2 border-secondary-subtle pb-2">
                    <span class="display-6 fs-5 fw-medium">Precios</span>
                  </header>
                  <div class="col-lg-6">
                    <div class="row my-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">Precio</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="Indique el precio" >
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="row my-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">Tipo de moneda</label>
                      <div class="col-sm-10">
                      <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Dolares</option>
                        <option value="1">Bolivares</option>
                      </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="row my-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">Precio</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo" placeholder="Indique el precio" disabled>
                      </div>
                    </div>
                    </div>
                  <div class="col-lg-6">
                    <div class="row my-3">
                      <label for="EtiquetaNombre" class="col-sm-2 col-form-label">Tipo de moneda</label>
                      <div class="col-sm-10">
                      <select class="form-select form-select-sm" aria-label="Small select example" disabled>
                        <option Value="2">Dolares</option>
                        <option value="1" selected>Bolivares</option>
                      </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <header class="border-bottom border-2 border-secondary-subtle pb-2">
                    <span class="display-6 fs-5 fw-medium">Descripcion del Producto</span>
                  </header>
                  <div class="col-lg mt-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="Desc-tab" data-bs-toggle="tab" data-bs-target="#Desc-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Descripcion</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Espec-tab" data-bs-toggle="tab" data-bs-target="#Espec-tab-pane" type="button" role="tab" aria-controls="Espec-tab-pane" aria-selected="false">Especificaciones Tecnicas</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active mb-3" id="Desc-tab-pane" role="tabpanel" aria-labelledby="Desc-tab" tabindex="0">
                        <div class="h-auto" id="editor">
                          <h2>Demo Content</h2>
                          <p>Aqui va la descripcion</p>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="Espec-tab-pane" role="tabpanel" aria-labelledby="Espec-tab" tabindex="0">
                        <div class="h-auto" id="editor2">
                          <div class="accordion mt-5" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="bi bi-cpu fs-3 me-3"></i> Procesador
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  <i class="bi bi-memory fs-3 me-3"></i>Memoria Ram
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  <i class="bi bi-hdd fs-3 me-3"></i>Memoria Interna
                                </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                  <i class="bi bi-motherboard fs-3 me-3"></i>Componentes
                                </button>
                              </h2>
                              <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="Review-tab-pane" role="tabpanel" aria-labelledby="Review-tab" tabindex="0">...</div>
                      <div class="tab-pane fade" id="Seller-tab-pane" role="tabpanel" aria-labelledby="Seller-tab" tabindex="0">...</div>
                    </div>
                    
                  </div>
                </div>
                <div class="row">
                  <header class="border-bottom border-2 border-secondary-subtle pb-2">
                    <span class="display-6 fs-5 fw-medium">Otros apartados</span>
                  </header>
                  <div class="col-lg">
                    Aqui deberia a ver un selector y agregado DE TAG's (#)
                  </div>
                </div>
                <div class="row">
                  <header class="border-bottom border-2 border-secondary-subtle pb-2">
                    <span class="display-6 fs-5 fw-medium">Otros apartados</span>
                  </header>
                  <div class="col-lg">
                    Aqui deberia a ver un selector y agregado DE TAG's (#)
                  </div>
                </div>
                <div class="row">
                  <header class="border-bottom border-2 border-secondary-subtle pb-2">
                    <span class="display-6 fs-5 fw-medium">Otros apartados</span>
                  </header>
                  <div class="col-lg">
                    Aqui deberia a ver un selector y agregado DE TAG's (#)
                  </div>
                </div>
</div>  
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="reset" class="btn btn-warning" value="Limpiar">
                <input type="submit" class="btn btn-success" value="Enviar">
              </div>
            </form>
          </div>
        </div>
      </div>
      
    <footer>
    <?php require_once("common/footer.php"); ?>
    </footer>
    <script src="js/quill.js"></script>
    <script>
      const quill = new Quill('#editor', {
        theme: 'snow'
      });
      
      const quill2 = new Quill('#editor2', {
        theme: 'snow'
      });
    </script>
    <script src="js/graficos.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/categoria.js"></script>
    <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    
    
</body>
</html>   