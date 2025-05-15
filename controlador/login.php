<?php

  if(isset($_GET['logear'])){
  switch ($_GET['logear']) {
    case '1':
      echo "hola";
      if(is_file("../modelo/login.php"))
      {
        require_once "../modelo/login.php";
      }else{
        echo "error, No se consigue el archivo";
        break;
      }
      $obj = new Usuario;
      $obj->Logeo($_POST['usuario'],$_POST['contrasena']);
      
      break;
    
    default:
      # code...
      break;
  }}else{

  if(is_file("vista/".$page.".php")){
	  require_once("vista/".$page.".php"); 
  }
  else{
	  require_once("vista/404.php"); 
  }
  }

?>