<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once $_SESSION['PATH'] . 'controller/controller.php';

class MCartorio extends controller {

 function listarEmailCartorios(){
     $this->sql="SELECT * FROM cartorio WHERE str_email !=''";
     
     return $this->query();
 }
  function listarQntCartorios(){
     $this->sql="SELECT DISTINCT id_estado, count(*) as total FROM cartorio GROUP BY id_estado";
     
     return $this->query();
 }
 

}

?>