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
    <title>Bienvenido AQui!</title>
    <?php require_once("common/linkcss.php"); ?>
</head>
<body>
    <header>
    <?php require_once("common/menu.php"); ?>
    </header>
    <!-- Sección de bienvenida -->
      <div class="container mt-5 ">
        <section class="row">
          <div class="col-lg col-md">
            <article id="carouselExampleIndicators" class="carousel slide">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner rounded-3" style="height: 40em">
                <div class="carousel-item active">
                  <img src="img/imagen1.jpg" class="d-block w-100 "  alt="...">
                </div>
                <div class="carousel-item">
                  <img src="img/imagen2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="img/imagen3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
            </article> 
          </div>          
        </section>
        <section class="row my-5">
          <header>
            <span class="display-6 fs-4 mb-3">Productos Recientes</span>
          </header>
          <article class='mt-5 '>
            <div class="row grupo-de-cartas center">
              
              <div class="col">
                <div class="card shadow shadow-3 h-auto w-auto" >
                  <img src="img/pcimg.png" class="card-img-top mx-auto" alt="" style="width: 16rem;">
                  <div class="card-body">
                    <p class="card-text">PC GAMER</p>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card shadow shadow-3 h-auto w-auto" >
                  <img src="img/pcimg.png" class="card-img-top mx-auto" style="width: 16rem;" alt="">
                  <div class="card-body">
                    <p class="card-text">PC GAMER</p>
                  </div>
                </div>  
              </div>

              <div class="col">
                <div class="card shadow shadow-3 h-auto w-auto">
                  <img src="img/pcimg.png" class="card-img-top mx-auto"style="width: 16rem; alt="">
                  <div class="card-body">
                    <p class="card-text">PC GAMER</p>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card shadow h-auto w-auto" style="">
                  <img src="img/pcimg.png" class="card-img-top mx-auto" style="width:16rem "alt="">
                  <div class="card-body">
                    <p class="card-text">PC GAMER</p>
                  </div>
                </div>
              </div>

            </div>
          </article>
        </section>
        <section class="row my-5">
          <article class="col-lg-6">
            <div class="card w-auto border shadow" style="background: #630f7d;
background: linear-gradient(148deg, rgba(99, 15, 125, 1) 0%, rgba(144, 27, 176, 1) 57%, rgba(189, 39, 227, 1) 100%); ;width:18em; height:18em">
              <div class="row h-100"> 
                <div class="col ms-2 text-center text-white d-flex flex-column justify-content-center">
                  <p class="display-6 fs-4 fw-bold">Para los mas atrevido</p>
                  <span class="display-6 fs-6">Consigue todas los componentes y accesorios para tu PC GAMER</span>
                </div>
                <div class="col" style="background-image:url('img/pcmorado.png');background-size: 120%;"></div>
              </div>
            </div>
          </article>
          <article class="col-lg-6">
            <div class="card w-auto border shadow" style="background:rgb(232, 193, 85);
background: linear-gradient(148deg, rgb(125, 85, 15) 0%, rgb(186, 136, 61) 57%, rgb(234, 193, 97) 100%); ;width:18em; height:18em">
              <div class="row h-100"> 
                <div class="col ms-2 text-center text-white d-flex flex-column justify-content-center">
                  <p class="display-6 fs-4 fw-bold">Para los mas atrevido</p>
                  <span class="display-6 fs-6">Consigue todas los componentes y accesorios para tu PC GAMER</span>
                </div>
                <div class="col" style="background-image:url('img/pcmorado.png');background-size: 120%;"></div>
              </div>
            </div>
          </article>
          
        </section>
        <section class="row">
          <header class="mb-4">
            <span class="display-6 fs-2">Productos Populares</span>
          </header>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
        </section>
        <section class="row mt-5">
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
        </section>
        <section class="row mt-5">
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
          <article class="col">
            
              <div class="card shadow h-auto w-auto" style="">
                <img src="img/pcimg.png" class="card-img-top mx-auto" alt="">
                <div class="card-body">
                  <p class="card-text">PC GAMER</p>
                </div>
              </div>
            
          </article>
        </section>
        <section class="row mt-5 d-flex justify-content-between" style="height:15em">
          <article class="col">
              <i class="bi bi-box-seam fs-1" style="color:orange"></i></br>
              <span class="display-6 fs-5 fw-semibold mt-4">Nuevos y Garantizados</span>
              <p class="display-6 fs-6 mt-2 text-secondary">Todos nuestros productos son articulos nuevos, y garantizados para su uso</p>
          </article>
          <article class="col">
            <i class="bi bi-bag-check fs-1" style="color:orange"></i></br>
            <span class="display-6 fs-5 fw-semibold mt-4">Completa tu pedido</span>
            <p class="display-6 fs-6 mt-2 text-secondary">Realiza tu pedido con nosotros, los productos seleccionados son para ti.</p>
          </article>
          <article class="col">
            <i class="bi bi-stopwatch fs-1" style="color:orange"></i></br>
            <span class="display-6 fs-5 fw-semibold mt-4">Envia con nosotros</span>
            <p class="display-6 fs-6 mt-2 text-secondary">Tu pedido puede ser enviados a nivel nacional. Probados y certificados con nostros</p>
          </article>
          <article class="col">
            <i class="bi bi-cpu fs-1" style="color:orange"></i></br>
            <span class="display-6 fs-5 fw-semibold mt-4">Productos de ultima generacion</span>
            <p class="display-6 fs-6 mt-2 text-secondary">Consigue los componentes de ultima generacion y los mas apropiados para tus equipos</p>
          </article>
        </section>
      </div>
    </main>
    <footer>
    <?php require_once("common/footer.php"); ?>
    </footer>
    <script src="js/landing.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    
</body>
</html> 