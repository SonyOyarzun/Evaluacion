<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Pregunta{
  
    private $id;
    private $nombre;
    private $descripcion;
    private $encuesta;
    private $fecha;
    
    private $condicion;

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEncuesta() {
        return $this->encuesta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEncuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

             
     // metodos
    function recuperarPregunta(Pregunta $pregunta) {

        $id_pregunta = $pregunta->getId();
        $id_encuesta = $pregunta->getEncuesta();
        $condicion   = $pregunta->getCondicion();
        $con         = Conexion::conectar();
                
        $sTable = " encuesta , pregunta";
        $sWhere = " WHERE encuesta.id_encuesta=pregunta.id_encuesta ";
                       
        if ($id_pregunta!=""){ 
           $sWhere .= " and id_pregunta='".$id_pregunta."' " ;
        }
         if ($id_encuesta!=""){ 
           $sWhere .= " and encuesta.id_encuesta=$id_encuesta";
        }
        
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        $sWhere.=" ORDER BY id_pregunta";

        $sql = " SELECT * FROM  $sTable $sWhere ";

 //     print_r($sql);
        
        $result = mysqli_query($con, $sql);
        return $result;
    }

      function registrarPregunta(Pregunta $pregunta){
          
        $id_encuesta = $pregunta->getEncuesta();
        $nombre      = $pregunta->getNombre();
        $descripcion = $pregunta->getDescripcion();
        $con         = Conexion::conectar();
          

      $sql=" INSERT INTO pregunta "
          ." (id_encuesta, nombre_pregunta, descripcion_pregunta) "
          ." VALUES ('$id_encuesta','$nombre','$descripcion') ";
     
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
     function editarPregunta(Pregunta $pregunta){
        
        $id_pregunta = $pregunta->getId();
        $nombre      = $pregunta->getNombre();
        $descripcion = $pregunta->getDescripcion();
        $con         = Conexion::conectar();
         
        $sql=" UPDATE pregunta "
            ." SET nombre_pregunta='".$nombre."', descripcion_pregunta='".$descripcion."' "
            ." WHERE id_pregunta='".$id_pregunta."'";
        
        $result=mysqli_query($con,$sql);
        return $result;
    }

    
    function eliminarPregunta(Pregunta $pregunta){
        
        $id_pregunta = $pregunta->getId();
        $con         = Conexion::conectar();
        
        $sql=" DELETE FROM pregunta WHERE id_pregunta='".$id_pregunta."' ";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
}