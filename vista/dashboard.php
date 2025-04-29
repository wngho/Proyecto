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
            <header class="mt-4 py-4 pb-5 border border-2 rounded-3 bg-warning border-warning shadow">
              <span class="display-6 text-secondary ms-2 ps-2 fw-medium"> Bienvenido de vuelta.</span><span class="display-6 text-secondary">Usuario</span>
            </header>
            <div class="row my-4">
              <div class="col-lg-6 d-flex justify-content-center">
                <div class="card h-auto w-100 border border-2 border-warning rounded-2 shadow shadow-3">
                  <div class="card-title display-6 fs-4 mx-3 mt-3 d-flex align-items-center">
                    <span class="flex-grow-1 ">Ordenes concretadas</span> <i class="bi bi-clipboard-check rounded-circle p-2 bg-primary text-white text-center" style="width:45px;height:45px"></i>
                  </div>
                  <div class="card-body pt-0 ">
                    <div class="card-text "> 
                      <span class="fs-2 fw-bold">65</span>
                      <span class="fs-4 ">Ordenes</span>  
                    </div>
                    <div class="card-text">
                      <figcaption class="blockquote-footer mb-0">En el mes de Abril</figcaption>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 d-flex justify-content-center">
                <div class="card h-auto w-100 border border-2 border-warning rounded-2 shadow shadow-3">
                  <div class="card-title display-6 fs-4 mx-3 mt-3 d-flex align-items-center">
                    <span class="flex-grow-1 ">Ventas realizadas</span> <i class="bi bi-cart-check rounded-circle p-2 bg-success text-white text-center" style="width:45px;height:45px"></i>
                  </div>
                  <div class="card-body pt-0 ">
                    <div class="card-text "> 
                      <span class="fs-2 fw-bold">36</span>
                      <span class="fs-4 ">Ventas</span>  
                    </div>
                    <div class="card-text">
                      <figcaption class="blockquote-footer mb-0">En el mes de Abril</figcaption>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <div class="row mb-4">
              <div class="col-lg-7">
                <div class="d-flex flex-column justify-content-start border rounded px-3 py-2">
                  <span class="display-5 fs-1 mt-2 mb-3">Ventas</span>
                  <canvas id="chartVentas"></canvas>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="d-flex flex-column justify-content-start border rounded px-3 py-2">
                  <span class="display-5 fs-1 mt-2 mb-3">Ventas</span>
                  <canvas class="h-25" id="chartOrdenPie"></canvas>
                </div>
                    
                
              </div>
            </div>
          
        </section>
      </main>
    <footer>
    <?php require_once("common/footer.php"); ?>
    </footer>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="js/graficos.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/categoria.js"></script>
    
    
</body>
</html>   