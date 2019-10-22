<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

class Historial {
    
    private $encuesta;
    private $nombre_encuesta;
    private $tipo_encuesta;
    private $usuario;
    private $evaluado;
    private $asignacion;
    private $fecha;
    private $estado;

    function getEncuesta() {
        return $this->encuesta;
    }

    function getNombre_encuesta() {
        return $this->nombre_encuesta;
    }

    function getTipo_encuesta() {
        return $this->tipo_encuesta;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getEvaluado() {
        return $this->evaluado;
    }

    function getAsignacion() {
        return $this->asignacion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getEstado() {
        return $this->estado;
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

    function setEncuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

    function setNombre_encuesta($nombre_encuesta) {
        $this->nombre_encuesta = $nombre_encuesta;
    }

    function setTipo_encuesta($tipo_encuesta) {
        $this->tipo_encuesta = $tipo_encuesta;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setEvaluado($evaluado) {
        $this->evaluado = $evaluado;
    }

    function setAsignacion($asignacion) {
        $this->asignacion = $asignacion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setEstado($estado) {
        $this->estado = $estado;
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
    
    function recuperarEncuestaHistorial(Historial $historial) {

        $id_usuario = $historial->getUsuario();
        $condicion  = $historial->getCondicion();
        $con        = Conexion::conectar();
                
        $sSelect = " SELECT DISTINCT historial.id_encuesta,nombre_encuesta,tipo_encuesta.nombre_tipo_encuesta ";
        $sTable = " FROM historial,tipo_encuesta ";
        $sWhere = " WHERE historial.tipo_encuesta=tipo_encuesta.id_tipo_encuesta ";

        if ($id_usuario != "") {
            $sWhere .= " AND historial.id_usuario='$id_usuario' ";
        }
        if ($condicion != "") {
            $sWhere .= $condicion;
        }

        $sql = " $sSelect  $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

    function recuperarHistorial(Historial $historial) {
        
       $id_encuesta = $historial->getEncuesta();
       $condicion   = $historial->getCondicion();
       $con         = Conexion::conectar();

       $sSelect = " SELECT historial.id_usuario_encuesta,historial.id_evaluado, historial.id_usuario, historial.fecha_historial, tipo_encuesta.nombre_tipo_encuesta ";
       $sTable  = " FROM historial,tipo_encuesta ";
       $sWhere  = " WHERE tipo_encuesta = id_tipo_encuesta ";
 
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if ($id_encuesta!=""){ 
          $sWhere.= " AND historial.id_encuesta='$id_encuesta' ";
        }
        $sWhere.=" ORDER BY historial.id_usuario_encuesta,historial.fecha_historial desc ";

        $sql = " $sSelect  $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
   //     print_r($sql);
        return $result;
    }

      function registrarHistorial(Historial $historial){
      
      $id_asignacion   = $historial->getAsignacion();    
      $id_encuesta     = $historial->getEncuesta();
      $id_usuario      = $historial->getUsuario();
      $id_evaluado     = $historial->getEvaluado();
      $nombre_encuesta = $historial->getNombre_encuesta();
      $tipo_encuesta   = $historial->getTipo_encuesta();
      $con             = Conexion::conectar();    
          
      $fecha_agregado=date("Y-m-d H:i:s");
        
      $sql="INSERT INTO historial (id_usuario_encuesta ,id_encuesta,id_usuario,id_evaluado,nombre_encuesta,tipo_encuesta,fecha_historial,estado_usuario_encuesta) "
                        . "VALUES ('$id_asignacion','$id_encuesta','$id_usuario','$id_evaluado','$nombre_encuesta','$tipo_encuesta','$fecha_agregado','2')";  
      
 //     print_r($sql);
      $result=mysqli_query($con,$sql);
      return $result;
    }
    function recuperarPromedio(Calificacion $calificacion, Encuesta $encuesta){
    
        $id_encuesta    = $encuesta    ->getId(); 
        $id_evaluado    = $calificacion->getEvaluado(); 
        $con            = Conexion::conectar();
        
       $sSelect = " SELECT avg(nota_calificacion),nombre_pregunta ";
             $sTable  = " FROM historial,pregunta,calificacion ";
             $sWhere  = " WHERE historial.id_encuesta=pregunta.id_encuesta "
                      . " AND pregunta.id_pregunta=calificacion.id_pregunta "
                      . " AND calificacion.id_evaluado=historial.id_evaluado "
                      . " AND historial.id_encuesta = '$id_encuesta' "
                      . " AND historial.id_evaluado='$id_evaluado' "
                      . " Group by nombre_pregunta "
                      . " ORDER BY pregunta.id_pregunta ";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=mysqli_query($con,$sql);
        return $result;
    }

    function recuperarDetallePorFecha(Historial $historial){
    
        $id_usuario  = $historial->getUsuario();
        $id_evaluado = $historial->getEvaluado();
        $fecha       = $historial->getFecha();
        $con         = Conexion::conectar();
                 
        $sSelect = " SELECT nota_calificacion,comentario_calificacion,nombre_pregunta,descripcion_pregunta,historial.id_usuario,historial.id_evaluado,historial.fecha_historial ";
             $sTable  = " FROM historial,pregunta,calificacion ";
             $sWhere  = " WHERE historial.id_encuesta=pregunta.id_encuesta  "
                      . " AND pregunta.id_pregunta=calificacion.id_pregunta  "
                      . " AND calificacion.id_usuario=historial.id_usuario "
                      . " AND calificacion.id_evaluado=historial.id_evaluado "
                      . " AND historial.id_usuario='$id_usuario' "
                      . " AND historial.id_evaluado='$id_evaluado' "
                      . " AND historial.fecha_historial = '$fecha' "
                      . " ORDER BY pregunta.id_pregunta ";
         
        $sql=" $sSelect $sTable $sWhere ";
     
  //      print_r($sql);
        
        $result=mysqli_query($con,$sql);
        return $result;
    }

     function recuperarComentarioGeneral(Historial $historial){
     
        $id_usuario   = $historial->getUsuario();
        $id_evaluado  = $historial->getEvaluado();
        $fecha        = $historial->getFecha();
        $con          = Conexion::conectar();
                
          $sSelect = " SELECT comentario_general.descripcion_comentario_general ";
            $sTable  = " FROM comentario_general, historial ";
            $sWhere  = " Where historial.id_usuario='$id_usuario' " 
                    . " AND historial.id_evaluado='$id_evaluado' "
                    . " AND historial.fecha_historial = '$fecha' "
                    . " AND comentario_general.id_encuesta=historial.id_encuesta "
                    . " AND comentario_general.fecha_comentario_general= historial.fecha_historial ";
            
        $sql=" $sSelect $sTable $sWhere ";
     
  //      print_r($sql);
        $result=mysqli_query($con,$sql);
        return $result;
    }
}
