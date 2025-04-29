<nav class="navbar navbar-expand-lg border-bottom " data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand mt-2 ms-2" href="<?php echo BASE_URL ; ?>">
      <img class="img-fluid" src="img/logo.png" alt="Logo" width="50%">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        
      </ul>
      <ul class="navbar-nav ">
        
        <li class="nav-item mx-1">
          <a class="nav-link active" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="ToolTikCustom" data-bs-title="Inicio" href="<?php echo BASE_URL; ?>">
            <i class="bi bi-house fs-4"></i>
          </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="ToolTikCustom" data-bs-title="Tienda" href="<?php echo BASE_URL;?>?page=tienda">
              <i class="bi bi-shop fs-4"></i>
            </a>
          </li>
        <li class="nav-item mx-1">
          <a class="nav-link" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="ToolTikCustom" data-bs-title="Carrito" href="#">
            <i class="bi bi-cart4 fs-4"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL;?>?page=dashboard">Dashboard</a>
        </li>
        
        <!-- Si en dado Caso lo utilizamos
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Modulo</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Accion</a>
            <a class="dropdown-item" href="#">Accion</a>
            <a class="dropdown-item" href="#">Accion</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Accion separada</a>
          </div>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL;?>?page=login">Iniciar sesion</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#">Salir</a>
        </li>
      </ul>
    </div>
  </div>
</nav>