<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Genero{
    
    private $id;
    private $nombre;
    
    private $con;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCon() {
        return $this->con;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCon($con) {
        $this->con = $con;
    }

            
 // metodos
    function recuperarGenero(Genero $genero) {

        $con = $genero->getCon();
        
        $sSelect = " SELECT id_genero,nombre_genero";
        $sTable  = " FROM  genero ";
        $sWhere  = "";
   
       
        $sWhere.=" order by nombre_genero ";
        

        $sql = " $sSelect $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

 
} 