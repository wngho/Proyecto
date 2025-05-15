<?php 
$page = "home"; 
session_start();
  if(file_exists("common/config.php"))
  {
    require_once "common/config.php";
  }
  
  if(file_exists("modelo/conexion.php")){
    require_once "modelo/conexion.php";
  }
  if (!empty($_GET['page']))
  {
    
    $page = $_GET['page'];
  // if (!isset($_SESSION['id_usuario']) && ($p != "principal" && $p != "login" && $p != "consulta" && $p != "detallesdeuda")) {
   //  header("Location: ?p=login");
   //}
  }
  if(is_file("controlador/".$page.".php")){ 
    
    require_once("controlador/".$page.".php");
  }
  else
  {
    
    require_once("controlador/404.php"); 
  }
?> 