<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Genero{
    
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
    function recuperarGenero() {

        $con = Conexion::conectar();
        
        $sSelect = " SELECT "
                . " id_genero, nombre_genero ";
        
        $sTable  = " FROM "
                 . " genero ";
        
        $sWhere  = "";
   
       
        $sWhere.=" order by nombre_genero ";
        

        $sql = " $sSelect $sTable $sWhere ";
  //      print_r($sql);
        $result = mysqli_query($con, $sql);
        return $result;
    }

 
} 