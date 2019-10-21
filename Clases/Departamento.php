<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Departamento{
    
    private $id;
    private $nombre;
    private $descripcion;
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

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

        
    
     // metodos
    function recuperarDepartamento(Departamento $departamento) {

        $id_departamento = $departamento->getId();
        $condicion       = $departamento->getCondicion();

        $con             = Conexion::conectar();       
        
        $sTable = " departamento ";
        $sWhere = "";
   
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if ($id_departamento!=""){ 
           $sWhere .= " WHERE id_departamento='".$id_departamento."' " ;
        }
        $sWhere.=" order by nombre_departamento";

        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

      function registrarDepartamento(Departamento $departamento){
          
      $nombre       = $departamento->getNombre();
      $descripcion  = $departamento->getDescripcion();
      $con          = Conexion::conectar();       
              
      $fecha_agregado=date("Y-m-d H:i:s");
     
      $sql=" INSERT INTO departamento "
          ." (nombre_departamento, descripcion_departamento,fecha_departamento) "
          ." VALUES ('$nombre','$descripcion','$fecha_agregado') "; 
     
        $result=mysqli_query($con,$sql);
     //   print_r($sql);
        return $result;
    }
    
    
     function editarDepartamento(Departamento $departamento){
         
        $id_departamento    = $departamento->getId();
        $nombre             = $departamento->getNombre();
        $descripcion        = $departamento->getDescripcion();
        $con                = Conexion::conectar();       
         
        $sql=" UPDATE departamento "
            ." SET nombre_departamento='".$nombre."', descripcion_departamento='".$descripcion."' "
            ." WHERE id_departamento='".$id_departamento."' ";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    function eliminarDepartamento(Departamento $departamento){
        
        $id_departamento    = $departamento->getId();
        $con                = Conexion::conectar();       
        
        $sql="DELETE FROM departamento WHERE id_departamento='".$id_departamento."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
    
    
} 