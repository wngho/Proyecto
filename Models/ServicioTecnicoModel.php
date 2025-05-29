<?php
class ServicioTecnicoModel extends Mysql
{
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

    public function __construct()
    {
        parent::__construct();
    }

    // Método para seleccionar todos los clientes (rolid = 3)
    public function selectClientes()
    {
        $sql = "SELECT idpersona, identificacion, nombres, apellidos, telefono, email_user 
                FROM persona 
                WHERE rolid = 3 AND status = 1 
                ORDER BY nombres ASC";
        return $this->select_all($sql);
    }

    // Método para seleccionar todos los estados activos
    public function selectEstados()
    {
        $sql = "SELECT idestado, nombre, color FROM estados WHERE status = 1";
        return $this->select_all($sql);
    }

    // Método para seleccionar todos los servicios activos
    public function selectServicios()
    {
        $sql = "SELECT s.idservicio, 
                       s.num_serie, 
                       s.descripcion, 
                       CONCAT(p.nombres,' ',p.apellidos) as cliente, 
                       e.nombre as estado, 
                       e.color,
                       s.fecha_entrada, 
                       s.fecha_salida,
                       s.status 
                FROM servicios s 
                INNER JOIN persona p ON s.idcliente = p.idpersona 
                INNER JOIN estados e ON s.idestado = e.idestado 
                WHERE s.status != 0
                ORDER BY s.fecha_entrada DESC";
        return $this->select_all($sql);
    }

    // Método para seleccionar servicios por estado
    public function selectServiciosByEstado(int $idEstado = null)
    {
        $sql = "SELECT s.idservicio, 
                       s.num_serie, 
                       s.descripcion, 
                       CONCAT(p.nombres,' ',p.apellidos) as cliente, 
                       e.nombre as estado,
                       e.color,
                       s.fecha_entrada, 
                       s.fecha_salida, 
                       s.status 
                FROM servicios s 
                INNER JOIN persona p ON s.idcliente = p.idpersona 
                INNER JOIN estados e ON s.idestado = e.idestado 
                WHERE s.status != 0";
        
        if($idEstado !== null) {
            $sql .= " AND s.idestado = $idEstado";
        }
        
        $sql .= " ORDER BY s.fecha_entrada DESC";
        return $this->select_all($sql);
    }

    // Método para seleccionar un servicio específico
    public function selectServicio(int $idServicio)
    {
        $sql = "SELECT s.idservicio, 
                       s.num_serie, 
                       s.descripcion, 
                       s.idcliente, 
                       s.idestado, 
                       e.nombre as estado, 
                       e.color, 
                       s.diagnostico, 
                       s.observaciones, 
                       s.fecha_entrada, 
                       s.fecha_salida,
                       p.nombres as cliente_nombre, 
                       p.apellidos as cliente_apellidos,
                       p.telefono as cliente_telefono, 
                       p.email_user as cliente_email
                FROM servicios s
                INNER JOIN persona p ON s.idcliente = p.idpersona
                INNER JOIN estados e ON s.idestado = e.idestado
                WHERE s.idservicio = $idServicio";
        return $this->select($sql);
    }

    // Método para insertar un nuevo servicio
    public function insertServicio(string $numSerie, string $descripcion, int $idCliente, int $idEstado, string $diagnostico, string $observaciones)
    {
        $this->strNumSerie = $numSerie;
        $this->strDescripcion = $descripcion;
        $this->intIdCliente = $idCliente;
        $this->intIdEstado = $idEstado;
        $this->strDiagnostico = $diagnostico;
        $this->strObservaciones = $observaciones;

        $sql = "INSERT INTO servicios(num_serie, descripcion, idcliente, idestado, diagnostico, observaciones, fecha_entrada) 
                VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
        $arrData = array(
            $this->strNumSerie, 
            $this->strDescripcion, 
            $this->intIdCliente, 
            $this->intIdEstado, 
            $this->strDiagnostico, 
            $this->strObservaciones
        );
        return $this->insert($sql, $arrData);
    }

    // Método para actualizar un servicio existente
    public function updateServicio(int $idServicio, string $numSerie, string $descripcion, int $idCliente, int $idEstado, string $diagnostico, string $observaciones)
    {
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
        $arrData = array(
            $this->strNumSerie, 
            $this->strDescripcion, 
            $this->intIdCliente, 
            $this->intIdEstado, 
            $this->strDiagnostico, 
            $this->strObservaciones
        );
        return $this->update($sql, $arrData);
    }

    // Método para actualizar solo el estado de un servicio
    public function updateServicioEstado(int $idServicio, int $idEstado)
    {
        $this->intIdServicio = $idServicio;
        $this->intIdEstado = $idEstado;

        $sql = "UPDATE servicios SET idestado = ? WHERE idservicio = ?";
        $arrData = array($this->intIdEstado, $this->intIdServicio);
        return $this->update($sql, $arrData);
    }

    // Método para "eliminar" un servicio (cambiar status a 0)
    public function deleteServicio(int $idServicio)
    {
        $this->intIdServicio = $idServicio;
        $sql = "UPDATE servicios SET status = ? WHERE idservicio = $this->intIdServicio";
        $arrData = array(0);
        return $this->update($sql, $arrData);
    }

    // Método para insertar un movimiento
    public function insertMovimiento(int $idServicio, int $idTecnico, int $idEstadoAnterior, int $idEstadoNuevo, string $descripcion)
    {
        $this->intIdServicio = $idServicio;
        $this->intIdTecnico = $idTecnico;
        $this->intIdEstadoAnterior = $idEstadoAnterior;
        $this->intIdEstadoNuevo = $idEstadoNuevo;
        $this->strDescMovimiento = $descripcion;

        $sql = "INSERT INTO movimientos(idservicio, idtecnico, idestado_anterior, idestado_nuevo, descripcion) 
                VALUES (?, ?, ?, ?, ?)";
        $arrData = array(
            $this->intIdServicio, 
            $this->intIdTecnico, 
            $this->intIdEstadoAnterior, 
            $this->intIdEstadoNuevo, 
            $this->strDescMovimiento
        );
        return $this->insert($sql, $arrData);
    }

    // Método para seleccionar los movimientos de un servicio
    public function selectMovimientos(int $idServicio)
    {
        $sql = "SELECT m.idmovimiento, 
                       m.fecha, 
                       CONCAT(p.nombres,' ',p.apellidos) as tecnico, 
                       ea.nombre as estado_anterior, 
                       en.nombre as estado_nuevo, 
                       m.descripcion 
                FROM movimientos m
                INNER JOIN persona p ON m.idtecnico = p.idpersona
                LEFT JOIN estados ea ON m.idestado_anterior = ea.idestado
                INNER JOIN estados en ON m.idestado_nuevo = en.idestado
                WHERE m.idservicio = $idServicio
                ORDER BY m.fecha DESC";
        return $this->select_all($sql);
    }

    // Método para insertar una foto
    public function insertFoto(int $idServicio, string $ruta, string $descripcion = null)
    {
        $this->intIdServicio = $idServicio;
        $this->strRutaFoto = $ruta;
        $this->strDescFoto = $descripcion;

        $sql = "INSERT INTO fotos(idservicio, ruta, descripcion) 
                VALUES (?, ?, ?)";
        $arrData = array($this->intIdServicio, $this->strRutaFoto, $this->strDescFoto);
        $response = $this->insert($sql, $arrData);
        return $response;
    }

    // Método para seleccionar las fotos de un servicio
    public function selectFotos(int $idServicio)
    {
        $sql = "SELECT idfoto, ruta, descripcion, fecha 
                FROM fotos 
                WHERE idservicio = $idServicio
                ORDER BY fecha DESC";
        return $this->select_all($sql);
    }

    // Método para eliminar una foto
    public function deleteFoto(int $idFoto)
    {
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