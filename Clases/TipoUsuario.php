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
    function recuperarTipoUsuario(TipoUsuario $tipo_usuario) {

        $con = $tipo_usuario->getCon();
        
        $sSelect = " SELECT id_tipo,nombre_tipo";
        $sTable  = " FROM  tipo ";
        $sWhere  = " ";
 
       
        $sWhere.=" order by id_tipo ";
        

        $sql = " $sSelect $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

 
} 