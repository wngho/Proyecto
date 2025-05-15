<?php
    require_once "../common/config.php";
    require_once "conexion.php";

    class Usuario extends Conexion{

        private $id;
        private $usuario;
        private $contrasena;
        private $rol;
        private $conexion;

        //Constructor

        public function __Construct(){
            $this->conexion =  $this->conecta();
        }

        //Set's

        public function SetId($param){
            if(isset($param)){
                $datos = $param;
                $this->SetIdPriv($param);
            }else{
                $resp = "Datos Invalidos";
                return $resp;
            }
        }
        private function SetIdPriv($param){
            $this->id = $param;
        }

        public function SetUsuario($param){
            if(isset($param)){
                $datos = $param;
                $this->SetUsuarioPriv($param);
            }else{
                $resp = "Datos Invalidos";
                return $resp;
            }
        }
        private function SetUsuarioPriv($param){
            $this->usuario = $param;
        }

        public function SetContrasena($param){
            if(isset($param)){
                $datos = $param;
                $this->SetContrasenaPriv($param);
            }else{
                $resp = "Datos Invalidos";
                return $resp;
            }
        }
        private function SetContrasenaPriv($param){
            $this->contrasena = $param;
        }

        public function SetRol($param){
            if(isset($param)){
                $datos = $param;
                $this->SetRolPriv($param);
            }else{
                $resp = "Datos Invalidos";
                return $resp;
            }
        }
        private function SetRolPriv($param){
            $this->rol = $param;
        }

        //Get's

        public function GetId(){
            $this->GetIdPriv();
        }

        private function GetIdPriv(){
            return $this->id;
        }

        public function GetUsuario(){
            $this->GetUsuarioPriv();
        }

        private function GetUsuarioPriv(){
            return $this->usuario;
        }

        public function GetContrasena(){
            $this->GetContrasenaPriv();
        }

        private function GetContrasenaPriv(){
            return $this->id;
        }
        public function GetRol(){
            $this->GetRolPriv();
        }

        private function GetRolPriv(){
            return $this->rol;
        }

        // ### ### //
        
        public function Logeo($param, $param2){
            try{
                $sql = "SELECT contrasena FROM usuario WHERE usuario = :dt_usuario;";
                $dato = array(':dt_usuario' => $param);
                $result = $this->conexion->prepare($sql);
                $result->execute($dato);
                $result = $result->fetch(PDO::FETCH_ASSOC);
                if ($param2 == $result['contrasena']/*$result && password_verify($param2, $result['contrasena'])*/) {
                session_start();
                //$_SESSION['rol'] = $resultado['id_rol'];
                //$_SESSION['id_usuario'] = $this->id_usuario;
                //$respuesta["ok"] = true;
                echo "Validado";
            } else {
                echo "dato no validado";}
                //$respuesta['ok'] = false;
                //$respuesta['mensaje'] = "Los datos ingresados son incorrectos";
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            //$respuesta['resultado'] = false;
            //$respuesta['mensaje'] = $e->getMessage();
        }
        //$this->desconecta();
        //return $respuesta;
        }

    }



?>