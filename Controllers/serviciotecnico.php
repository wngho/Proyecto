<?php 
class ServicioTecnico extends Controllers{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/login');
            die();
        }
        getPermisos(MDSERVICIOT);
    }

    public function ServicioTecnico()
    {
        if(empty($_SESSION['permisosMod']['r'])){
            header("Location:".base_url().'/dashboard');
        }
        $data['page_tag'] = "Servicio Técnico";
        $data['page_title'] = "SERVICIO TÉCNICO";
        $data['page_name'] = "servicio_tecnico";
        $data['page_functions_js'] = "functions_servicios.js";
        $this->views->getView($this,"serviciotecnico",$data);
    }

    public function getServicios()
    {
        if($_SESSION['permisosMod']['r']){
            $arrData = $this->model->selectServicios();
            for ($i=0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnHistory = '';
                $btnDelete = '';
                $btnAddMovimiento = '';

                if($arrData[$i]['status'] == 1)
                {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                $arrData[$i]['fecha_entrada'] = date('d-m-Y', strtotime($arrData[$i]['fecha_entrada']));
                $arrData[$i]['fecha_salida'] = ($arrData[$i]['fecha_salida'] != null) ? date('d-m-Y', strtotime($arrData[$i]['fecha_salida'])) : '';

                if($_SESSION['permisosMod']['r']){
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idservicio'].')" title="Ver servicio"><i class="far fa-eye"></i></button>';
                    $btnHistory = '<button class="btn btn-secondary btn-sm" onClick="fntViewHistory('.$arrData[$i]['idservicio'].')" title="Historial"><i class="fas fa-history"></i></button>';
                }
                if($_SESSION['permisosMod']['u']){
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idservicio'].')" title="Editar servicio"><i class="fas fa-pencil-alt"></i></button>';
                    $btnAddMovimiento = '<button class="btn btn-info btn-sm" onClick="addMovimiento('.$arrData[$i]['idservicio'].')" title="Agregar Movimiento"><i class="fas fa-plus-circle"></i></button>';
                }
                if($_SESSION['permisosMod']['d']){    
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idservicio'].')" title="Eliminar servicio"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnHistory.' '.$btnEdit.' '.$btnAddMovimiento.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getServiciosByEstado($idEstado)
    {
        if($_SESSION['permisosMod']['r']){
            $idEstado = intval($idEstado);
            $arrData = $this->model->selectServiciosByEstado($idEstado);
            for ($i=0; $i < count($arrData); $i++) {
                $arrData[$i]['fecha_entrada'] = date('d-m-Y', strtotime($arrData[$i]['fecha_entrada']));
                $arrData[$i]['fecha_salida'] = ($arrData[$i]['fecha_salida'] != null) ? date('d-m-Y', strtotime($arrData[$i]['fecha_salida'])) : '';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setServicio(){
        if($_POST){
            if(empty($_POST['txtNumSerie']) || empty($_POST['listCliente']) || empty($_POST['listEstado']) )
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                
                $idServicio = intval($_POST['idServicio']);
                $strNumSerie = strClean($_POST['txtNumSerie']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $intIdCliente = intval($_POST['listCliente']);
                $intIdEstado = intval($_POST['listEstado']);
                $strDiagnostico = strClean($_POST['txtDiagnostico']);
                $strObservaciones = strClean($_POST['txtObservaciones']);
                $request_servicio = "";

                if($idServicio == 0)
                {
                    $option = 1;
                    if($_SESSION['permisosMod']['w']){
                        $request_servicio = $this->model->insertServicio($strNumSerie, 
                                                                    $strDescripcion, 
                                                                    $intIdCliente, 
                                                                    $intIdEstado,
                                                                    $strDiagnostico, 
                                                                    $strObservaciones);
                    }
                }else{
                    $option = 2;
                    if($_SESSION['permisosMod']['u']){
                        $request_servicio = $this->model->updateServicio($idServicio,
                                                                    $strNumSerie,
                                                                    $strDescripcion, 
                                                                    $intIdCliente,
                                                                    $intIdEstado,
                                                                    $strDiagnostico, 
                                                                    $strObservaciones);
                    }
                }

                if($request_servicio > 0 )
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'idservicio' => $request_servicio, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'idservicio' => $idServicio, 'msg' => 'Datos actualizados correctamente.');
                    }
                }else if($request_servicio == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! El número de serie ya existe.');        
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getServicio($idservicio){
        if($_SESSION['permisosMod']['r']){
            $idservicio = intval($idservicio);
            if($idservicio > 0){
                $arrData = $this->model->selectServicio($idservicio);
                if(empty($arrData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrImg = $this->model->selectFotos($idservicio);
                    if(count($arrImg) > 0){
                        for ($i=0; $i < count($arrImg); $i++) { 
                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['ruta'];
                        }
                    }
                    $arrData['images'] = $arrImg;
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function setMovimiento(){
        if($_POST){
            if(empty($_POST['idservicio']) || empty($_POST['idestado_nuevo']) || empty($_POST['txtDescripcion']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                $idServicio = intval($_POST['idservicio']);
                $idEstadoNuevo = intval($_POST['idestado_nuevo']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $idTecnico = $_SESSION['idUser'];

                // Obtener estado actual del servicio
                $infoServicio = $this->model->selectServicio($idServicio);
                $idEstadoAnterior = $infoServicio['idestado'];

                // Insertar movimiento
                $request_movimiento = $this->model->insertMovimiento($idServicio, $idTecnico, $idEstadoAnterior, $idEstadoNuevo, $strDescripcion);

                // Actualizar estado del servicio
                if($request_movimiento > 0){
                    $request_update = $this->model->updateServicioEstado($idServicio, $idEstadoNuevo);
                    
                    // Si el estado es "Entregado", actualizar fecha de salida
                    if($idEstadoNuevo == 5){ // Asumiendo que 5 es el ID para "Entregado"
                        $sql = "UPDATE servicios SET fecha_salida = CURRENT_TIMESTAMP WHERE idservicio = ?";
                        $this->model->update($sql, array($idServicio));
                    }

                    $arrResponse = array('status' => true, 'msg' => 'Movimiento registrado correctamente.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al registrar el movimiento.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getMovimientos($idservicio){
        if($_SESSION['permisosMod']['r']){
            $idservicio = intval($idservicio);
            $arrData = $this->model->selectMovimientos($idservicio);
            for ($i=0; $i < count($arrData); $i++) {
                $arrData[$i]['fecha'] = date('d-m-Y H:i', strtotime($arrData[$i]['fecha']));
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setFoto(){
        if($_POST){
            if(empty($_POST['idservicio'])){
                $arrResponse = array('status' => false, 'msg' => 'Error de dato.');
            }else{
                $idServicio = intval($_POST['idservicio']);
                $foto = $_FILES['foto'];
                $strDescripcion = !empty($_POST['txtDescripcionFoto']) ? strClean($_POST['txtDescripcionFoto']) : null;
                $imgNombre = 'serv_'.md5(date('d-m-Y H:i:s')).'.jpg';
                
                $request_image = $this->model->insertFoto($idServicio, $imgNombre, $strDescripcion);
                if($request_image){
                    $uploadImage = uploadImage($foto, $imgNombre);
                    $arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.', 'idimg' => $request_image);
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error de carga.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delFile(){
        if($_POST){
            if(empty($_POST['idservicio']) || empty($_POST['idfoto'])){
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                $idServicio = intval($_POST['idservicio']);
                $imgNombre = strClean($_POST['idfoto']);
                $imgruta = strClean($_POST['imgNombre']);
                $request_image = $this->model->deleteFoto($imgNombre);

                if($request_image){
                    $deleteFile = deleteFile($imgruta);
                    $arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delServicio(){
        if($_POST){
            if($_SESSION['permisosMod']['d']){
                $intIdservicio = intval($_POST['idServicio']);
                $requestDelete = $this->model->deleteServicio($intIdservicio);
                if($requestDelete)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el servicio');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el servicio.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getClientes(){
        if($_SESSION['permisosMod']['r']){
            $arrData = $this->model->selectClientes();
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getEstados(){
        if($_SESSION['permisosMod']['r']){
            $arrData = $this->model->selectEstados();
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>