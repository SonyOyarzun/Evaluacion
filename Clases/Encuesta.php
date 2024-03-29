<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Encuesta{
  
    private $id;
    private $nombre;
    private $tipo;
    private $asignacion;
    private $estado;
    private $fecha;
    
    //cada cuanto tiempo se realizan evaluaciones en meses
    private $regla_evaluacion;   
    private $condicion;
 
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getAsignacion() {
        return $this->asignacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getRegla_evaluacion() {
        return $this->regla_evaluacion;
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

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setAsignacion($asignacion) {
        $this->asignacion = $asignacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setRegla_evaluacion($regla_evaluacion) {
        $this->regla_evaluacion = $regla_evaluacion;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    
    
        
     // metodos
    function recuperarEncuesta(Encuesta $encuesta) {

        $condicion = $encuesta->getCondicion();
        $con       = Conexion::conectar();
         
        $sSelect = " SELECT id_encuesta,nombre_encuesta,nombre_tipo_encuesta,id_tipo_encuesta,fecha_encuesta ";
        
        $sTable  = " FROM "
                 . " encuesta,tipo_encuesta ";
        
        $sWhere  = " WHERE "
                 . " encuesta.tipo_encuesta = tipo_encuesta.id_tipo_encuesta "
                 . " AND encuesta.estado_encuesta = 1 ";
        
   
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        $sWhere.=" ORDER BY id_encuesta";
        
        $sql = " $sSelect  $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

      function registrarEncuesta(Encuesta $encuesta){
          
       $nombre          = $encuesta->getNombre();
       $tipo_encuesta   = $encuesta->getTipo();
       $con             = Conexion::conectar();  
       $fecha_agregado=date("Y-m-d H:i:s");
     
       $sql="INSERT INTO encuesta (nombre_encuesta,tipo_encuesta, fecha_encuesta, estado_encuesta)"
              . " VALUES ('$nombre','$tipo_encuesta','$fecha_agregado','1')";
     
        $result=mysqli_query($con,$sql);
        return $result;
    }
    

    
    function deshabilitarEncuesta(Encuesta $encuesta){
        
        $id_encuesta     = $encuesta->getId();
        $con             = Conexion::conectar();
        
        $sql = " UPDATE encuesta SET estado_encuesta= 2 WHERE id_encuesta='$id_encuesta'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    

     function verificarAsignarEncuesta(Usuario $usuario, Encuesta $encuesta){
     
        $reglaevaluacion = "1";
        $id_encuesta     = $encuesta ->getId();
        $id_usuario      = $usuario  ->getId();
        $con             = Conexion::conectar();
        
        $sSelect = " SELECT * ";
        
        $sFrom   = " FROM usuario_encuesta ";
        
        $sWhere  = " WHERE id_usuario='$id_usuario' AND id_encuesta='$id_encuesta' AND ( fecha_usuario_encuesta BETWEEN fecha_usuario_encuesta AND DATE(DATE_ADD(fecha_usuario_encuesta, INTERVAL $reglaevaluacion MONTH)) ) ";    
        
        $sql = " $sSelect $sFrom $sWhere"; 
            
        $result=mysqli_query($con,$sql);
     //   print_r($sql);
        return $result;
    }
    
     function asignarEncuesta(Usuario $usuario,Encuesta $encuesta){
         
        $id_encuesta     = $encuesta ->getId();
        $id_usuario      = $usuario  ->getid();
        $con             = Conexion::conectar();
         
         
        $fecha_agregado=date("Y-m-d H:i:s");
        $sql="INSERT INTO usuario_encuesta "
            ."(id_usuario,id_encuesta,fecha_usuario_encuesta,estado_usuario_encuesta) "
            ."VALUES ('$id_usuario','$id_encuesta','$fecha_agregado',1)";
        $result=mysqli_query($con,$sql);
   //    print_r($sql);
        return $result;
    }
    
    function recuperarEncuestaAsignada(Usuario $usuario) {

        $id_usuario    = $usuario  ->getId();
        $condicion     = $usuario  ->getCondicion();
        $con           = Conexion::conectar();
                
        $sSelect = " SELECT "
                 . " usuario_encuesta.id_usuario_encuesta, encuesta.id_encuesta,encuesta.tipo_encuesta,"
                 . " usuario_encuesta.id_usuario,encuesta.nombre_encuesta,estado_asignacion.nombre_estado_asignacion,"
                 . " tipo_encuesta.nombre_tipo_encuesta,usuario_encuesta.fecha_usuario_encuesta ";
        
        $sTable  = " FROM "
                . " usuario, encuesta, usuario_encuesta,estado_asignacion,tipo_encuesta ";
        
        $sWhere  = " WHERE "
                 . " usuario.id_usuario=usuario_encuesta.id_usuario "
                 . " AND encuesta.id_encuesta=usuario_encuesta.id_encuesta  "
                 . " AND usuario_encuesta.estado_usuario_encuesta=estado_asignacion.id_estado_asignacion "
                 . " AND tipo_encuesta.id_tipo_encuesta=encuesta.tipo_encuesta "
                 . " AND estado_asignacion.id_estado_asignacion= '1' ";
               
        
     
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
        if ($id_usuario!=""){
           $sWhere .=" AND usuario.id_usuario= '$id_usuario' ";
        }
       
        $sWhere.=" ORDER BY id_encuesta ";
   
        $sql = " $sSelect  $sTable $sWhere ";

   //     print_r($sql);
        $result = mysqli_query($con, $sql);     
        return $result;
    }
    
    function encuestaCompletada(Encuesta $encuesta){
        
          $id_asignacion = $encuesta->getAsignacion();
          $con           = Conexion::conectar();
        
          $sql= " UPDATE usuario_encuesta SET estado_usuario_encuesta= 2 WHERE id_usuario_encuesta='$id_asignacion'";
          $result = mysqli_query($con, $sql);
          return $result;
    }
}
