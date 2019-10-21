<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

class Calificacion {
   private $id;
   private $comentario;
   private $nota;
   private $usuario;
   private $evaluado;
   private $fecha;
    
   private $condicion;

   function getId() {
       return $this->id;
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

   function setId($id) {
       $this->id = $id;
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
      
      $id_pregunta   = $calificacion->getId_pregunta();
      $id_usuario    = $calificacion->getId_usuario();
      $id_evaluado   = $calificacion->getId_evaluado();
      $notas         = $calificacion->getCalificacion_nota();
      $comentario    = $calificacion->getComentario_calificacion();
      $con           = $calificacion->getCon();
          
      $fecha_agregado=date("Y-m-d H:i:s");
        
      $sql="INSERT INTO calificacion (id_pregunta,id_usuario,id_evaluado, calificacion_nota, comentario_calificacion ,fecha_agregado) "
                       . "VALUES('$id_pregunta','$id_usuario','$id_evaluado','$notas',' $comentario','$fecha_agregado') "  ;
      
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    function registrarComentarioGeneral(Calificacion $calificacion, Encuesta $encuesta){
  
      $id_encuesta   = $encuesta    ->getId(); 
      $id_usuario    = $calificacion->getId_usuario();
      $id_evaluado   = $calificacion->getId_evaluado();
      $comentario    = $calificacion->getComentario_calificacion();
      $con           = $calificacion->getCon();
      
      $fecha_agregado=date("Y-m-d H:i:s");
        
      $sql="INSERT INTO comentariofinal (id_encuesta,comentario,id_usuario,id_evaluado,fecha_agregado) "
                        . "VALUES ('$id_encuesta','$comentario','$id_usuario','$id_evaluado','$fecha_agregado')";
     
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
    
    
       
    
}
