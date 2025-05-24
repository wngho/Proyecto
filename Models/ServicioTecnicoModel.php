<?php
class ServicioTecnicoModel extends MySql {
    private $intIdServicio;
    private $strNumSerie;
    private $strDescripcion;
    private $intIdCliente;
    private $intIdEstado;
    private $strDiagnostico;
    private $strObservaciones;
    private $dateFechaEntrada;
    private $dateFechaSalida;
    private $intIdMovimiento;
    private $intIdTecnico;
    private $intIdEstadoAnterior;
    private $intIdEstadoNuevo;
    private $strDescMovimiento;
    private $strRutaFoto;
    private $strDescFoto;

    public function __construct() {
        parent::__construct();
    }

    public function selectClientes() {
        $sql = "SELECT idpersona, nombres, apellidos 
                FROM persona 
                WHERE rolid = 3 AND status = 1 
                ORDER BY nombres ASC";
        return $this->select_all($sql);
    }

    public function selectEstados() {
        $sql = "SELECT idestado, nombre, color FROM estados WHERE status = 1";
        return $this->select_all($sql);
    }

    public function selectServicios() {
        $sql = "SELECT s.idservicio, 
                       s.num_serie, 
                       s.descripcion, 
                       c.nombres as cliente, 
                       e.nombre as estado, 
                       e.color,
                       s.fecha_entrada, 
                       s.fecha_salida,
                       s.status 
                FROM servicios s 
                INNER JOIN persona c ON s.idcliente = c.idpersona 
                INNER JOIN estados e ON s.idestado = e.idestado 
                WHERE s.status != 0
                ORDER BY s.fecha_entrada DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectServiciosByEstado(int $idEstado = null) {
        $sql = "SELECT s.idservicio, 
                       s.num_serie, 
                       s.descripcion, 
                       c.nombres as cliente, 
                       e.nombre as estado,
                       e.color,
                       s.fecha_entrada, 
                       s.fecha_salida, 
                       s.status 
                FROM servicios s 
                INNER JOIN persona c ON s.idcliente = c.idpersona 
                INNER JOIN estados e ON s.idestado = e.idestado 
                WHERE s.status != 0";
        
        if($idEstado !== null) {
            $sql .= " AND s.idestado = $idEstado";
        }
        
        $sql .= " ORDER BY s.fecha_entrada DESC";
        return $this->select_all($sql);
    }

    public function selectServicio(int $idServicio) {
        $sql = "SELECT s.idservicio, s.num_serie, s.descripcion, s.idcliente, 
                       s.idestado, e.nombre as estado, e.color, s.diagnostico, 
                       s.observaciones, s.fecha_entrada, s.fecha_salida,
                       c.nombres as cliente_nombre, c.apellidos as cliente_apellidos,
                       c.telefono as cliente_telefono, c.email_user as cliente_email
                FROM servicios s
                INNER JOIN persona c ON s.idcliente = c.idpersona
                INNER JOIN estados e ON s.idestado = e.idestado
                WHERE s.idservicio = $idServicio";
        return $this->select($sql);
    }

    public function insertServicio(string $numSerie, string $descripcion, int $idCliente, int $idEstado, string $diagnostico, string $observaciones) {
        $this->strNumSerie = $numSerie;
        $this->strDescripcion = $descripcion;
        $this->intIdCliente = $idCliente;
        $this->intIdEstado = $idEstado;
        $this->strDiagnostico = $diagnostico;
        $this->strObservaciones = $observaciones;

        $sql = "INSERT INTO servicios(num_serie, descripcion, idcliente, idestado, diagnostico, observaciones, fecha_entrada) 
                VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
        $arrData = array($this->strNumSerie, $this->strDescripcion, $this->intIdCliente, $this->intIdEstado, $this->strDiagnostico, $this->strObservaciones);
        $request = $this->insert($sql, $arrData);
        return $request;
    }

    public function updateServicio(int $idServicio, string $numSerie, string $descripcion, int $idCliente, int $idEstado, string $diagnostico, string $observaciones) {
        $this->intIdServicio = $idServicio;
        $this->strNumSerie = $numSerie;
        $this->strDescripcion = $descripcion;
        $this->intIdCliente = $idCliente;
        $this->intIdEstado = $idEstado;
        $this->strDiagnostico = $diagnostico;
        $this->strObservaciones = $observaciones;

        $sql = "UPDATE servicios 
                SET num_serie = ?, 
                    descripcion = ?, 
                    idcliente = ?, 
                    idestado = ?, 
                    diagnostico = ?, 
                    observaciones = ? 
                WHERE idservicio = $this->intIdServicio";
        $arrData = array($this->strNumSerie, $this->strDescripcion, $this->intIdCliente, $this->intIdEstado, $this->strDiagnostico, $this->strObservaciones);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function updateServicioEstado(int $idServicio, int $idEstado) {
        $this->intIdServicio = $idServicio;
        $this->intIdEstado = $idEstado;

        $sql = "UPDATE servicios SET idestado = ? WHERE idservicio = ?";
        $arrData = array($this->intIdEstado, $this->intIdServicio);
        return $this->update($sql, $arrData);
    }

    public function deleteServicio(int $idServicio) {
        $this->intIdServicio = $idServicio;
        $sql = "UPDATE servicios SET status = ? WHERE idservicio = $this->intIdServicio";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function insertMovimiento(int $idServicio, int $idTecnico, int $idEstadoAnterior, int $idEstadoNuevo, string $descripcion) {
        $this->intIdServicio = $idServicio;
        $this->intIdTecnico = $idTecnico;
        $this->intIdEstadoAnterior = $idEstadoAnterior;
        $this->intIdEstadoNuevo = $idEstadoNuevo;
        $this->strDescMovimiento = $descripcion;

        $sql = "INSERT INTO movimientos(idservicio, idtecnico, idestado_anterior, idestado_nuevo, descripcion) 
                VALUES (?, ?, ?, ?, ?)";
        $arrData = array($this->intIdServicio, $this->intIdTecnico, $this->intIdEstadoAnterior, 
                         $this->intIdEstadoNuevo, $this->strDescMovimiento);
        return $this->insert($sql, $arrData);
    }

    public function selectMovimientos(int $idServicio) {
        $sql = "SELECT m.idmovimiento, 
                       m.fecha, 
                       u.nombres as tecnico, 
                       ea.nombre as estado_anterior, 
                       en.nombre as estado_nuevo, 
                       m.descripcion 
                FROM movimientos m
                INNER JOIN persona u ON m.idtecnico = u.idpersona
                LEFT JOIN estados ea ON m.idestado_anterior = ea.idestado
                INNER JOIN estados en ON m.idestado_nuevo = en.idestado
                WHERE m.idservicio = $idServicio
                ORDER BY m.fecha DESC";
        return $this->select_all($sql);
    }

    public function insertFoto(int $idServicio, string $ruta, string $descripcion = null) {
        $this->intIdServicio = $idServicio;
        $this->strRutaFoto = $ruta;
        $this->strDescFoto = $descripcion;

        $sql = "INSERT INTO fotos(idservicio, ruta, descripcion) 
                VALUES (?, ?, ?)";
        $arrData = array($this->intIdServicio, $this->strRutaFoto, $this->strDescFoto);
        return $this->insert($sql, $arrData);
    }

    public function selectFotos(int $idServicio) {
        $sql = "SELECT idfoto, ruta, descripcion, fecha 
                FROM fotos 
                WHERE idservicio = $idServicio
                ORDER BY fecha DESC";
        return $this->select_all($sql);
    }

    public function deleteFoto(int $idFoto) {
        $this->intIdFoto = $idFoto;
        $sql = "SELECT ruta FROM fotos WHERE idfoto = $this->intIdFoto";
        $request = $this->select($sql);
        
        if(!empty($request)) {
            $sql = "DELETE FROM fotos WHERE idfoto = $this->intIdFoto";
            $request_delete = $this->delete($sql);
            if($request_delete) {
                return $request['ruta']; // Devuelve la ruta para eliminar el archivo físico
            }
        }
        return false;
    }
}
?>