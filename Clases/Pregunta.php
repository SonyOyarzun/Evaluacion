<?php


Class Pregunta{
  
    private $id;
    private $nombre;
    private $descripcion;
    private $encuesta;
    private $fecha;
    
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

    function getEncuesta() {
        return $this->encuesta;
    }

    function getFecha() {
        return $this->fecha;
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

    function setEncuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
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
    function recuperarPregunta(Pregunta $pregunta) {

        $id_pregunta = $pregunta->getId();
        $id_encuesta = $pregunta->getId_encuesta();
        $condicion   = $pregunta->getCondicion();
        $offset      = $pregunta->getOffset();
        $per_page    = $pregunta->getPer_page();
        $con         = $pregunta->getCon();
                
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
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " SELECT * FROM  $sTable $sWhere ";

 //     print_r($sql);
        
        $result = mysqli_query($con, $sql);
        return $result;
    }

      function registrarPregunta(Pregunta $pregunta){
          
        $id_encuesta = $pregunta->getId_encuesta();
        $nombre      = $pregunta->getNombre();
        $descripcion = $pregunta->getDescripcion();
        $con         = $pregunta->getCon();
          

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
        $con         = $pregunta->getCon();
         
        $sql=" UPDATE pregunta "
            ." SET nombre_pregunta='".$nombre."', descripcion_pregunta='".$descripcion."' "
            ." WHERE id_pregunta='".$id_pregunta."'";
        
        $result=mysqli_query($con,$sql);
        return $result;
    }

    
    function eliminarPregunta(Pregunta $pregunta){
        
        $id_pregunta = $pregunta->getId();
        $con         = $pregunta->getCon();
        
        $sql=" DELETE FROM pregunta WHERE id_pregunta='".$id_pregunta."' ";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
}