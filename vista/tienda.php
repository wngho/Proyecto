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
        <div class="gx-10 row">
          <div class="aside col-md-3 col-lg-3 bg-grey">
            <header>
              <span class="display-6 fs-4">
                Categorias
              </span>
            </header>
            <div class="list-group list-group-flush mt-3 mb-5">
                    <!-- Dairy, Bread & Eggs -->
                    <div class="category-item">
                        <div class="display-6 fs-5 category-header arrow " onclick="toggleCategory(this)">
                            Memorias
                        </div>
                        <div id="dairySubcategories" class=" subcategories">
                            <div class="display-6 fs-6 subcategory-item">Mecanico</div>
                            <div class="display-6 fs-6 subcategory-item">SSD</div>
                            <div class="display-6 fs-6 subcategory-item">M.2</div>
                            <div class="display-6 fs-6 subcategory-item">Pendrive's</div>
                            <div class="display-6 fs-6 subcategory-item">MicroSD</div>
                        </div>
                    </div>
                    
                    <!-- Snacks & Munchies -->
                    <div class="category-item">
                        <div class="display-6 fs-5 category-header arrow " onclick="toggleCategory(this)">
                            Procesadores
                        </div>
                        <div id="snacksSubcategories" class=" subcategories">
                            <div class="display-6 fs-6 subcategory-item">AMD</div>
                            <div class="display-6 fs-6 subcategory-item">Intel</div>
                            
                            
                        </div>
                    </div>
                    
                    <!-- Fruits & Vegetables -->
                    <div class="category-item">
                        <div class="display-6 fs-5 category-header arrow"  onclick="toggleCategory( this)">
                            Memorias Rams
                        </div>
                        <div id="fruitsVeggiesSubcategories" class="subcategories">
                            <div class="display-6 fs-6 subcategory-item">Ddr2</div>
                            <div class="display-6 fs-6 subcategory-item">Ddr3</div>
                            <div class="display-6 fs-6 subcategory-item">Ddr4</div>
                            <div class="display-6 fs-6 subcategory-item">Ddr5</div>
                        </div>
                    </div>
                    
                    <!-- Cold Drinks & Juices -->
                    <div class="category-item">
                        <div class="display-6 fs-5 category-header arrow "  onclick="toggleCategory( this)">
                            Accesorios
                        </div>
                        <div id="drinksSubcategories" class="subcategories">
                            <div class="display-6 fs-6 subcategory-item">Audio</div>
                            <div class="display-6 fs-6 subcategory-item">Dispositivos de Entradas</div>
                            <div class="display-6 fs-6 subcategory-item">Microfonos</div>
                            <div class="display-6 fs-6 subcategory-item">Luces</div>
                        </div>
                    </div>
                    
                    <!-- Agrega las demás categorías de la misma forma -->
                </div>
            
          
          </div>
          <section class="col-lg-9 ">
            <header class="px-3 mb-3">
                <p class="display-5 d-flex bg-secondary rounded text-white px-4 py-5">Memorias Rams</br></p>
            </header>
            <article>
              <div class="d-flex mb-2">
                <div class="me-auto p-2 display-6 fs-5"><span class="ps-2 fw-bold">25</span> Productos encontrados</div>
                <div class="ms-auto">
                  <button class="btn btn-warning me-3"><i class="bi bi-filter"></i></button>
                </div>
              </div>
            </article>
            <article class="d-flex flex-row justify-content-between">
                <a href="?page=retail">
                  <div class="card shadow h-auto w-auto mx-3" style="">
                    <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                    <div class="card-body">
                      <p class="card-text">PC GAMER</p>
                    </div>
                  </div>
                </a>
                <div class="">
                  <div class="card shadow h-auto w-auto mx-3" style="">
                    <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                    <div class="card-body">
                      <p class="card-text">PC GAMER</p>
                    </div>
                  </div>
                </div>
                <div class="">
                  <div class="card shadow h-auto w-auto mx-3" style="">
                    <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                    <div class="card-body">
                      <p class="card-text">PC GAMER</p>
                    </div>
                  </div>
                </div>
                <div class="">
                  <div class="card shadow h-auto w-auto mx-3" style="">
                    <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                    <div class="card-body">
                      <p class="card-text">PC GAMER</p>
                    </div>
                  </div>
                </div>
                <div class="">
                  <div class="card shadow h-auto w-auto mx-3" style="">
                    <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                    <div class="card-body">
                      <p class="card-text">PC GAMER</p>
                    </div>
                  </div>
                </div>
              </article>
          </section>
        </div>
      </div>
    </main>
    <footer>
    <?php require_once("common/footer.php"); ?>
    </footer>
    <script src="js/landing.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/categoria.js"></script>
    
</body>
</html> 