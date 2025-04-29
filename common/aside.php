



<aside class="col-lg-2 border-end">
    <nav class="nav flex-column display-6 fs-6 fw-medium">
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'dashboard')echo 'active';?> mb-2 mt-1" aria-current="page" href="<?php echo BASE_URL;?>?page=dashboard">
            <i class="bi bi-house me-1 fs-4 me-1"></i>
            <span class="fs-6 fst-normal "> Inicio</span>
        </a>
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'productos')echo 'active';?> my-1" aria-current="page" href="<?php echo BASE_URL;?>?page=productos">
            <i class="bi bi-box-seam me-1 fs-4 me-1"></i>
            <span class="fs-6 fst-normal "> Productos</span>
        </a>
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'ventas')echo 'active';?> my-1" aria-current="page" href="<?php echo BASE_URL;?>?page=ventas">
            <i class="bi bi-cart me-1 fs-4 me-1"></i>
            <span class="fs-6 fst-normal "> Ventas</span>
        </a>
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'compra')echo 'active';?> my-1" aria-current="page" href="<?php echo BASE_URL;?>?page=compras">
            <i class="bi bi-bag me-1 fs-4 me-1"></i>
            <span class="fs-6 fst-normal "> Compras</span>
        </a>
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'movimientos')echo 'active';?> my-1" aria-current="page" href="<?php echo BASE_URL;?>?page=servicioTec">
            <i class="bi bi-wrench fs-4 me-1"></i>
            <span class="fs-6 fst-normal ">Servicio Tecnico</span>
        </a>
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'conf-home')echo 'active';?> my-1" aria-current="page" href="<?php echo BASE_URL;?>?page=configHome">
            <i class="bi bi-house-gear fs-4 me-1"></i>
            <span class="fs-6 fst-normal ">Conf. de Home</span>
        </a>
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'conf-home')echo 'active';?> my-1" aria-current="page" href="<?php echo BASE_URL;?>?page=reportes">
            <i class="bi bi-file-earmark-text fs-4 me-1"></i>
            <span class="fs-6 fst-normal ">Reportes</span>
        </a>
        <a class="nav-link btn btn-outline-warning text-start text-reset <?php if($_GET['page'] == 'conf-home')echo 'active';?> my-1" aria-current="page" href="<?php echo BASE_URL;?>?page=estadisticas">
            <i class="bi bi-bar-chart-line fs-4 me-1"></i>
            <span class="fs-6 fst-normal ">Estadisticas</span>
        </a>
    </nav>
</aside>