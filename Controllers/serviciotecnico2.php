<?php
class ServicioTecnico extends Controllers {
    public function __construct() {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login'])) {
            header('Location: '.base_url().'/login');
            die();
        }
        getPermisos(MDSERVICIOT);
    }

    public function ServicioTecnico() {
        if(empty($_SESSION['permisosMod']['r'])){
            header('Location: '.base_url().'/dashboard');
        }
        $data['page_tag'] = "Servicio Técnico";
        $data['page_title'] = "SERVICIO TÉCNICO";
        $data['page_name'] = "servicio_tecnico";
        $data['page_functions_js'] = "functions_servicios.js";
        $this->views->getView($this, 'servicios', $data);
    }

    public function getServicios() {
        if($_SESSION['permisosMod']['r']){
            $arrData = $this->model->selectServicios();
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setServicio() {
        if($_POST) {
            if(empty($_POST['txtNumSerie']) || empty($_POST['txtDescripcion']) || empty($_POST['listCliente']) || empty($_POST['listEstado'])) {
                $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
            } else {
                $intIdServicio = intval($_POST['idServicio']);
                $strNumSerie = strClean($_POST['txtNumSerie']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $intIdCliente = intval($_POST['listCliente']);
                $intIdEstado = intval($_POST['listEstado']);
                $strDiagnostico = strClean($_POST['txtDiagnostico']);
                $strObservaciones = strClean($_POST['txtObservaciones']);

                if($intIdServicio == 0) {
                    // Crear
                    $request = $this->model->insertServicio($strNumSerie, $strDescripcion, $intIdCliente, $intIdEstado, $strDiagnostico, $strObservaciones);
                    $option = 1;
                } else {
                    // Actualizar
                    $request = $this->model->updateServicio($intIdServicio, $strNumSerie, $strDescripcion, $intIdCliente, $intIdEstado, $strDiagnostico, $strObservaciones);
                    $option = 2;
                }

                if($request > 0) {
                    if($option == 1) {
                        $arrResponse = array("status" => true, "msg" => "Datos guardados correctamente.");
                    } else {
                        $arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente.");
                    }
                } else {
                    $arrResponse = array("status" => false, "msg" => "No se pudo almacenar la información.");
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delServicio() {
        if($_POST) {
            if($_SESSION['permisosMod']['d']) {
                $intIdServicio = intval($_POST['idServicio']);
                $request = $this->model->deleteServicio($intIdServicio);
                if($request == "ok") {
                    $arrResponse = array("status" => true, "msg" => "Se ha eliminado el servicio.");
                } else {
                    $arrResponse = array("status" => false, "msg" => "Error al eliminar el servicio.");
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
	public function getServicio($id) {
        if($_SESSION['permisosMod']['r']){
            $idServicio = intval($id);
            if($idServicio > 0){
                $arrData = $this->model->selectServicio($idServicio);
                $arrData['movimientos'] = $this->model->selectMovimientos($idServicio);
                $arrData['fotos'] = $this->model->selectFotos($idServicio);
                
                if(empty($arrData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function setMovimiento() {
        if($_POST && $_SESSION['permisosMod']['u']) {
            $intIdServicio = intval($_POST['idServicio']);
            $intIdEstadoNuevo = intval($_POST['listEstadoNuevo']);
            $strDescripcion = strClean($_POST['txtDescMovimiento']);
            
            // Obtener estado actual
            $servicio = $this->model->selectServicio($intIdServicio);
            $intIdEstadoAnterior = $servicio['idestado'];
            
            $request = $this->model->insertMovimiento(
                $intIdServicio, 
                $_SESSION['idUser'], 
                $intIdEstadoAnterior, 
                $intIdEstadoNuevo, 
                $strDescripcion
            );
            
            // Actualizar estado del servicio
            if($request > 0) {
                $this->model->updateServicioEstado($intIdServicio, $intIdEstadoNuevo);
                $arrResponse = array('status' => true, 'msg' => 'Movimiento registrado correctamente.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al registrar movimiento.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setFoto() {
        if($_FILES && $_SESSION['permisosMod']['u']) {
            $idServicio = intval($_POST['idServicioFoto']);
            $descripcion = strClean($_POST['txtDescFoto'] ?? '');
            
            // Subir imagen
            $foto = $_FILES['foto'];
            $nombreFoto = 'serv_'.$idServicio.'_'.bin2hex(random_bytes(6)).'.'.pathinfo($foto['name'], PATHINFO_EXTENSION);
            $ruta = "Assets/images/servicios/".$nombreFoto;
            
            if(move_uploaded_file($foto['tmp_name'], $ruta)) {
                $request = $this->model->insertFoto($idServicio, $ruta, $descripcion);
                if($request > 0) {
                    $arrResponse = array('status' => true, 'msg' => 'Foto subida correctamente.', 'ruta' => $ruta);
                } else {
                    unlink($ruta); // Eliminar foto si falla la BD
                    $arrResponse = array('status' => false, 'msg' => 'Error al registrar foto.');
                }
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al subir el archivo.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delFoto() {
        if($_POST && $_SESSION['permisosMod']['d']) {
            $idFoto = intval($_POST['idFoto']);
            $ruta = $this->model->deleteFoto($idFoto);
            
            if($ruta !== false) {
                if(file_exists($ruta)) {
                    unlink($ruta); // Eliminar archivo físico
                }
                $arrResponse = array('status' => true, 'msg' => 'Foto eliminada correctamente.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar foto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>