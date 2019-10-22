<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

class Calificacion {
   private $pregunta;
   private $comentario;
   private $nota;
   private $usuario;
   private $evaluado;
   private $fecha;
    
   private $condicion;

   function getPregunta() {
       return $this->pregunta;
   }

   function getComentario() {
       return $this->comentario;
   }

   function getNota() {
       return $this->nota;
   }

   function getUsuario() {
       return $this->usuario;
   }

   function getEvaluado() {
       return $this->evaluado;
   }

   function getFecha() {
       return $this->fecha;
   }

   function getCondicion() {
       return $this->condicion;
   }

   function setPregunta($pregunta) {
       $this->pregunta = $pregunta;
   }

   function setComentario($comentario) {
       $this->comentario = $comentario;
   }

   function setNota($nota) {
       $this->nota = $nota;
   }

   function setUsuario($usuario) {
       $this->usuario = $usuario;
   }

   function setEvaluado($evaluado) {
       $this->evaluado = $evaluado;
   }

   function setFecha($fecha) {
       $this->fecha = $fecha;
   }

   function setCondicion($condicion) {
       $this->condicion = $condicion;
   }

         
      function registrarCalificacion(Calificacion $calificacion){
      
      $id_pregunta   = $calificacion->getPregunta();
      $id_usuario    = $calificacion->getUsuario();
      $id_evaluado   = $calificacion->getEvaluado();
      $notas         = $calificacion->getNota();
      $comentario    = $calificacion->getComentario();
      $con           = Conexion::conectar();
          
      $fecha_agregado=date("Y-m-d H:i:s");
        
      $sql="INSERT INTO calificacion (id_pregunta,id_usuario,id_evaluado, nota_calificacion, comentario_calificacion ,fecha_calificacion) "
                       . "VALUES('$id_pregunta','$id_usuario','$id_evaluado','$notas',' $comentario','$fecha_agregado') "  ;
      
        $result=mysqli_query($con,$sql);
      //  print_r($sql);
        return $result;
    }
    
    function registrarComentarioGeneral(Calificacion $calificacion, Encuesta $encuesta){
  
      $id_encuesta   = $encuesta    ->getId(); 
      $id_usuario    = $calificacion->getUsuario();
      $id_evaluado   = $calificacion->getEvaluado();
      $comentario    = $calificacion->getComentario();
      $con           = Conexion::conectar();
      
      $fecha_agregado=date("Y-m-d H:i:s");
        
      $sql="INSERT INTO comentario_general (id_encuesta,descripcion_comentario_general,id_usuario,id_evaluado,fecha_comentario_general) "
                        . "VALUES ('$id_encuesta','$comentario','$id_usuario','$id_evaluado','$fecha_agregado')";
     
        $result=mysqli_query($con,$sql);
   //     print_r($sql);
        return $result;
    }
    
    
    
    
       
    
}
