<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

class ComentarioGeneral {

    private $encuesta;
    private $comentario;
    private $usuario;
    private $evaluado;
    private $fecha;
    
    private $condicion;

    function getEncuesta() {
        return $this->encuesta;
    }

    function getComentario() {
        return $this->comentario;
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

    function setEncuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

    function setComentario($comentario) {
        $this->comentario = $comentario;
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

                    
        // metodos
    function recuperarComentario($encuesta,$usuario) {

        $sTable = " comentariofinal ";
        $sWhere = "";
   
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if ($id_comentario!=""){ 
           $sWhere .= " WHERE id_encuesta='".$id_encuesta."' " ;
        }
        $sWhere.=" order by comentario";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
        return $result;
    }

      
    function registrarComentarioGeneral(ComentarioGeneral $comentario_general){
      
      $id_encuesta        = $comentario_general->getId_encuesta();
      $comentario_general = $comentario_general->getComentario();
      $id_usuario         = $comentario_general->getId_usuario();        
      $id_evaluado        = $comentario_general->getId_evaluado();
      $con                = $comentario_general->getCon();  
        
      $fecha_agregado=date("Y-m-d H:i:s");
        
      $sql = " INSERT INTO comentariofinal (id_encuesta,comentario,id_usuario,id_evaluado,fecha_agregado) "
           . " VALUES ('$id_encuesta','$comentario_general','$id_usuario','$id_evaluado','$fecha_agregado')";
     
        $result=mysqli_query($con,$sql);
        return $result;
    }
    

      
} 

