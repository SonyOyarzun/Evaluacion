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
    function recuperarTipoEncuesta(TipoEncuesta $tipo_encuesta) {

        $con = $tipo_encuesta->getCon();
        
        $sSelect = " SELECT id_tipo,nombre_tipo";
        $sTable  = " FROM  tipoencuesta ";
        $sWhere  = "";
 
       
        $sWhere.=" order by id_tipo ";
        

        $sql = " $sSelect $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

}
