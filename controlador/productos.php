<?php

  if(is_file("vista/".$page.".php")){
	  require_once("vista/".$page.".php"); 
  }
  else{
	  require_once("vista/404.php"); 
  }

?>