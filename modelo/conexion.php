<?php

class Conexion extends PDO{

    private $pdo = "";
    private $db;
    private $user;
    private $host;
    private $pass;

    public function __construct(){

    }
    public function conecta()
    {
        $this->db = DB;
        $this->user = USER;
        $this->pass = PASS;
        $this->host = HOST;
        
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . "", $this->user, $this->pass);
            $this->pdo->exec("SET names utf8;");
            // $_SESSION["id_usuario"] = $_SESSION["id_usuario"] ?? "22222222";
            #if (isset($_SESSION["id_usuario"])) {
            #    $usuario_actual = $_SESSION["id_usuario"];
            #    $this->pdo->exec("SET @usuario_actual = '$usuario_actual';");
            #}
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            return null;
        }
    }

    protected function verificarConexion()
    {
        if ($this->pdo === null) {
            throw new Exception("Error: No se pudo establecer la conexión a la base de datos.");
        }
    }
    public function desconecta()
    {
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }
}



?>