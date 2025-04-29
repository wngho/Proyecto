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
    <title>Tienda!</title>
    <?php require_once("common/linkcss.php"); ?>
</head>
<body>
    <header>
    <?php require_once("common/menu.php"); ?>
    </header>
    <!-- Sección de bienvenida -->
      <div class="container mt-5 ">

        <section class="row">
          <header>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="fst-italic">Pc de Escritorio</a></li>
                <li class="breadcrumb-item"><a href="#" class="fst-italic">12 Gen</a></li>
                <li class="breadcrumb-item active fst-italic" aria-current="page" >Gamer</li>
              </ol>
            </nav>
          </header class="">
          <aside class="col-lg-5 mt-3">
            <img src="img/pcimg.png" alt="producto" class="img-fluid border border-2 rounded-4">
          </aside>
          <div class="col-1"></div>
          <article class="col-lg-6 mt-3">
            <div class="row">
              <div class="col">
                <div class="border-bottom border-secondary-subtle pb-4">
                  <span class="blockquotes text-secondary">
                    Pc de Escritorio
                  </span></br>
                  <span class="display-4 fw-medium">PC Gamer</span></br>
                  <span class="estrellas text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                  </span>
                  <span class="blockquotes text-success">  (5 Reviews)</span>
                  <div class="precio mt-3">
                    <span class="display-6 fs-3 fw-bold">$ 380</span>
                    <span class="display-6 fs-3 fw-medium text-secondary text-decoration-line-through">$ 450</span>
                    <span class="display-6 fs-3 fw-bold">$ 380</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col ms-3 mt-3">
                <button class="btn btn-outline-dark me-2">Negro</button>
                <button class="btn btn-outline-dark">Blanco</button>    
              </div>              
            </div>
              <div class="row">
                <div class="col">
                  <div class="quantity-counter d-flex align-items-center input-group mt-3 ms-3">
                    <button class="quantity-btn btn btn-outline-danger border-secondary rounded-start" onclick="decrement()">-</button>
                    <input type="number" class="quantity-input form-control border-secondary" id="quantity" value="1" min="15">
                    <button class="quantity-btn btn btn-outline-success border-secondary rounded-end" onclick="increment()">+</button>
                  </div>
                </div>
              </div>
              <div class="row mt-3 border-bottom border-secondary-subtle pb-4">
                <div class="col">
                  <button class="btn btn-success ms-3 fs-5"><i class="bi bi-bag-dash-fill me-2"></i>Añadir al carrito</button>
                  <button class="btn btn-outline-danger fs-5"><i class="bi bi-heart"></i></button>
                </div>
              </div>
              <div class="row mt-3 text-secondary">
                <div class="row my-3 ">
                  <div class="col-4">
                    <span class="fw-bold">Codigo del Producto:</span>
                  </div>
                  <div class="col-6">
                    <span class="fw-medium">3F67S98A2DS</span>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-4">
                    <span class="fw-bold">Disponibilidad:</span>
                  </div>
                  <div class="col-6">
                    <span class="fw-medium">Disponible</span>
                  </div>
                </div>
                
                <div class="row my-3">
                  <div class="col-4">
                    <span class="fw-bold">Dias para realizar el despacho:</span>
                  </div>
                  <div class="col-6">
                    <span class="fw-medium">3 Dias</span>
                  </div>
                </div>
                </div>
          </article>

        <section class="row mt-3 mb-3 ">
          <div class="row">
            <div class="col">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="Desc-tab" data-bs-toggle="tab" data-bs-target="#Desc-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Descripcion</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Espec-tab" data-bs-toggle="tab" data-bs-target="#Espec-tab-pane" type="button" role="tab" aria-controls="Espec-tab-pane" aria-selected="false">Especificaciones Tecnicas</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Review-tab" data-bs-toggle="tab" data-bs-target="#Review-tab-pane" type="button" role="tab" aria-controls="Review-tab-pane" aria-selected="false">Reviews</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="Seller-tab" data-bs-toggle="tab" data-bs-target="#Seller-tab-pane" type="button" role="tab" aria-controls="Seller-tab-pane" aria-selected="false" >Opiniones del vendedor</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="Desc-tab-pane" role="tabpanel" aria-labelledby="Desc-tab" tabindex="0">Aqui va la descripcion</div>
              <div class="tab-pane fade" id="Espec-tab-pane" role="tabpanel" aria-labelledby="Espec-tab" tabindex="0">

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
              <div class="tab-pane fade" id="Review-tab-pane" role="tabpanel" aria-labelledby="Review-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="Seller-tab-pane" role="tabpanel" aria-labelledby="Seller-tab" tabindex="0">...</div>
            </div>

        </section>

      </div>
    <footer>
    <?php require_once("common/footer.php"); ?>
    </footer>
    <script src="js/landing.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/categoria.js"></script>
    <script src="js/contador.js"></script>
    
</body>
</html>   