<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Estado{
    
    private $id;
    private $nombre;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    
    
 // metodos
    function recuperarEstado() {

        $con = Conexion::conectar();
        
        $sSelect = " SELECT "
                . " id_estado, nombre_estado ";
        
        $sTable  = " FROM "
                 . " estado ";
        
        $sWhere  = "";
   
       
        $sWhere.=" order by nombre_estado ";
        

        $sql = " $sSelect $sTable $sWhere ";
  //      print_r($sql);
        $result = mysqli_query($con, $sql);
        return $result;
    }

 
} 