<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

class TipoEncuesta {
 private $id_tipo;
 private $nombre_tipo;

 function getId_tipo() {
     return $this->id_tipo;
 }

 function getNombre_tipo() {
     return $this->nombre_tipo;
 }

 function setId_tipo($id_tipo) {
     $this->id_tipo = $id_tipo;
 }

 function setNombre_tipo($nombre_tipo) {
     $this->nombre_tipo = $nombre_tipo;
 }

 
  // metodos
    function recuperarTipoEncuesta() {

        $con = Conexion::conectar();
        
        $sSelect = " SELECT id_tipo_encuesta,nombre_tipo_encuesta";
        $sTable  = " FROM  tipo_encuesta ";
        $sWhere  = "";
 
       
        $sWhere.=" order by id_tipo_encuesta ";
        

        $sql = " $sSelect $sTable $sWhere ";
        $result = mysqli_query($con, $sql);
   //     print_r($sql);
        return $result;
    }

}
