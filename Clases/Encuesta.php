<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Encuesta{
  
    private $id;
    private $nombre;
    private $tipo;
    private $asignnacion;
    private $fecha;
    
    //cada cuanto tiempo se realizan evaluaciones en meses
    private $reglaevaluacion;   
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

    function getAsignnacion() {
        return $this->asignnacion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getReglaevaluacion() {
        return $this->reglaevaluacion;
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

    function setAsignnacion($asignnacion) {
        $this->asignnacion = $asignnacion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setReglaevaluacion($reglaevaluacion) {
        $this->reglaevaluacion = $reglaevaluacion;
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
                 . " encuesta.tipo_encuesta = tipo_encuesta.id_tipo_encuesta ";
        
   
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
    

    
    function eliminarEncuesta(Encuesta $encuesta){
        
        $id_encuesta     = $encuesta->getId();
        $con             = Conexion::conectar();
        
        $sql=" DELETE FROM encuesta WHERE id_encuesta='".$id_encuesta."' ";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    

     function verificarAsignarEncuesta(Usuario $usuario, Encuesta $encuesta){
     
        $reglaevaluacion = $encuesta ->getReglaevaluacion();
        $id_encuesta     = $encuesta ->getId();
        $id_usuario      = $usuario  ->getRut();
        $con             = Conexion::conectar();
        
        $sql="SELECT * FROM usuarioencuesta WHERE id_usuario='$id_usuario' AND id_encuesta='$id_encuesta' AND ( fecha_agregado BETWEEN 'fecha_agregado' AND DATE(DATE_ADD(fecha_agregado, INTERVAL $reglaevaluacion MONTH)) ) ";    
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
     function asignarEncuesta(Usuario $usuario,Encuesta $encuesta){
         
        $id_encuesta     = $encuesta ->getId();
        $id_usuario      = $usuario  ->getRut();
        $con             = Conexion::conectar();
         
         
        $fecha_agregado=date("Y-m-d H:i:s");
        $sql="INSERT INTO usuarioencuesta "
            ."(id_usuario,id_encuesta,fecha_agregado,estado) "
            ."VALUES ('$id_usuario','$id_encuesta','$fecha_agregado',1)";
        $result=mysqli_query($con,$sql);
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

    //    print_r($sql);
        $result = mysqli_query($con, $sql);     
        return $result;
    }
    
    function encuestaCompletada(Encuesta $encuesta){
        
          $id_asignacion = $encuesta->getId_asignnacion();
          $con           = $encuesta->getCon();
        
          $sql= " UPDATE usuarioencuesta SET estado= 2 WHERE id_asignacion='$id_asignacion'";
          $result = mysqli_query($con, $sql);
          return $result;
    }
}
