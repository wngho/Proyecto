<?php 
headerAdmin($data); 
getModal('modalServicios', $data);
getModal('modalMovimientos', $data);
getModal('modalFotos', $data);
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-tools"></i> <?= $data['page_title'] ?></h1>
            <?php if($_SESSION['permisosMod']['w']){ ?>
                <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo Servicio</button>
            <?php } ?>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/serviciotecnico"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableServicios">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>N° Serie</th>
                                    <th>Descripción</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Fecha Entrada</th>
                                    <th>Fecha Salida</th>
                                    <th>Acciones</th>
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