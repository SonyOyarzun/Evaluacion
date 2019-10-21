<?php


Class Departamento{
    
    private $id;
    private $nombre;
    private $descripcion;
    private $fecha_agregado;
    
    private $condicion;
    private $offset;
    private $per_page;
    private $con;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha_agregado() {
        return $this->fecha_agregado;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getOffset() {
        return $this->offset;
    }

    function getPer_page() {
        return $this->per_page;
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

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFecha_agregado($fecha_agregado) {
        $this->fecha_agregado = $fecha_agregado;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setOffset($offset) {
        $this->offset = $offset;
    }

    function setPer_page($per_page) {
        $this->per_page = $per_page;
    }

    function setCon($con) {
        $this->con = $con;
    }

    
     // metodos
    function recuperarDepartamento(Departamento $departamento) {

        $id_departamento = $departamento->getId();
        $condicion       = $departamento->getCondicion();
        $offset          = $departamento->getOffset();
        $per_page        = $departamento->getPer_page();
        $con             = $departamento->getCon();        
        
        $sTable = " departamento ";
        $sWhere = "";
   
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if ($id_departamento!=""){ 
           $sWhere .= " WHERE id_departamento='".$id_departamento."' " ;
        }
        $sWhere.=" order by nombre_departamento";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

      function registrarDepartamento(Departamento $departamento){
          
      $nombre       = $departamento->getNombre();
      $descripcion  = $departamento->getDescripcion();
      $con          = $departamento->getCon();
              
      $fecha_agregado=date("Y-m-d H:i:s");
     
      $sql=" INSERT INTO departamento "
          ." (nombre_departamento, descripcion_departamento,fecha_agregado) "
          ." VALUES ('$nombre','$descripcion','$fecha_agregado') "; 
     
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
     function editarDepartamento(Departamento $departamento){
         
        $id_departamento    = $departamento->getId();
        $nombre             = $departamento->getNombre();
        $descripcion        = $departamento->getDescripcion();
        $con                = $departamento->getCon();
         
        $sql=" UPDATE departamento "
            ." SET nombre_departamento='".$nombre."', descripcion_departamento='".$descripcion."' "
            ." WHERE id_departamento='".$id_departamento."' ";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    function eliminarDepartamento(Departamento $departamento){
        
        $id_departamento    = $departamento->getId();
        $con                = $departamento->getCon();
        
        $sql="DELETE FROM departamento WHERE id_departamento='".$id_departamento."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
    
    
} 