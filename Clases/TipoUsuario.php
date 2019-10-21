<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class TipoUsuario{
    
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
    function recuperarTipoUsuario() {

        $con = Conexion::conectar();
        
        $sSelect = " SELECT id_tipo_usuario, nombre_tipo_usuario ";
        $sTable  = " FROM  tipo_usuario ";
        $sWhere  = "";
 
       
        $sWhere.=" order by id_tipo_usuario ";
        

        $sql = " $sSelect $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

 
} 