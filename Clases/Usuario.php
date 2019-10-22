<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Evaluacion/config/conexion.php');

Class Usuario{
    
    private $id;
    private $nombre;
    private $apellido;
    private $genero;
    private $departamento;
    private $mail;
    private $tipo;
    private $clave;
    private $fecha;
    private $estado;
    
    private $condicion;

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getGenero() {
        return $this->genero;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getMail() {
        return $this->mail;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getClave() {
        return $this->clave;
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

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setClave($clave) {
        $this->clave = $clave;
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

            
    // metodos
    function recuperarUsuario(Usuario $usuario) {

        $id         = $usuario->getId();
        $condicion  = $usuario->getCondicion();  
        $con        = Conexion::conectar();
        
        $sSelect = " SELECT "
                 . " id_usuario, nombre_usuario, apellido_usuario, id_genero, nombre_genero ,"
                 . " id_departamento, nombre_departamento, mail_usuario, id_tipo_usuario, nombre_tipo_usuario, fecha_usuario";
        
        $sTable  = " FROM "
                 . " usuario, genero, tipo_usuario, departamento ";
        
        $sWhere  = " WHERE "
                 . " usuario.genero_usuario = id_genero "
                 . " AND  usuario.tipo_usuario = tipo_usuario.id_tipo_usuario "
                 . " AND  usuario.departamento_usuario = departamento.id_departamento ";
                
       
      
   
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if ($id!=""){ 
           $sWhere .= " AND usuario.id_usuario = '$id' " ;
        }else{
           $sWhere .= " AND  usuario.estado_usuario = 1 "; 
        }
        
        $sWhere.=" ORDER BY usuario.id_usuario DESC ";


        $sql = " $sSelect   $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
     // print_r($sql);
        return $result;
    }

      function registrarUsuario(Usuario $usuario){
      
      $rut          = $usuario->getId();
      $nombre       = $usuario->getNombre();
      $apellido     = $usuario->getApellido();
      $clave_hash   = $usuario->getClave();
      $email        = $usuario->getMail();
      $tipo         = $usuario->getTipo();
      $genero       = $usuario->getGenero();
      $departamento = $usuario->getDepartamento();
      $con          = Conexion::conectar();
              
      $fechaAgregado=date("Y-m-d H:i:s");
        
      $sql = "INSERT INTO usuario " 
           . " (id_usuario, nombre_usuario, apellido_usuario , clave_usuario, mail_usuario, fecha_usuario, tipo_usuario , genero_usuario, departamento_usuario, estado_usuario) "
           . " VALUES('".$rut."','".$nombre."','".$apellido."','" . $clave_hash . "', '" . $email . "', '" . $fechaAgregado . "','".$tipo."' ,'".$genero."','".$departamento."','1')";
      
   //   print_r($sql);
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
     function editarUsuario(Usuario $usuario){
         
      $id           = $usuario->getId();
      $nombre       = $usuario->getNombre();
      $apellido     = $usuario->getApellido();
      $email        = $usuario->getMail();
      $tipo         = $usuario->getTipo();
      $genero       = $usuario->getGenero();
      $departamento = $usuario->getDepartamento();
      $con          = Conexion::conectar();
         
        $sql="UPDATE usuario "
            ."SET nombre_usuario='".$nombre."', apellido_usuario='".$apellido."', mail_usuario ='".$email."', "
            ."tipo_usuario='".$tipo."', genero_usuario='".$genero."', departamento_usuario='".$departamento."' "
            ."WHERE id_usuario='".$id."';";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
     function editarClave(Usuario $usuario){
         
        $id     = $usuario->getId();
        $clave  = $usuario->getClave();
        $con    = Conexion::conectar();
        
        $sql = "UPDATE usuario SET clave_usuario='".$clave."' WHERE id_usuario='".$id."'";
     //   print_r($sql); 
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    function deshabilitarUsuario(Usuario $usuario){
        
        $id     = $usuario->getId();
        $con    = Conexion::conectar();
        
        $sql="UPDATE usuario SET estado_usuario = '2' WHERE id_usuario='".$id."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
 
    function habilitarUsuario(Usuario $usuario){
        
        $id     = $usuario->getId();
        $con    = Conexion::conectar();
        
        $sql="UPDATE usuario SET estado_usuario = '1' WHERE id_usuario='".$id."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }

    function verificarUsuarioPorEvaluar(Historial $historial, Departamento $departamento, Encuesta $encuesta){
        
       $id_asignacion   = $historial    ->getAsignacion();
       $id_departamento = $departamento ->getId();
       $tipo            = $encuesta     ->getTipo();
       $con             = Conexion::conectar();

        
         $Excep = " SELECT usuario.id_usuario "
                . " FROM historial,usuario_encuesta,usuario "
                . " WHERE usuario.id_usuario=historial.id_evaluado "
                . " AND usuario_encuesta.id_usuario_encuesta=historial.id_usuario_encuesta "
                . " AND historial.id_usuario_encuesta = '$id_asignacion' ";
                                             
        
         $sql = " SELECT usuario.id_usuario,usuario.nombre_usuario,usuario.apellido_usuario "
                . " FROM usuario, departamento, tipo_usuario " 
                . " WHERE usuario.tipo_usuario=tipo_usuario.id_tipo_usuario "
                . " AND usuario.id_usuario not in($Excep) "
                . " AND usuario.departamento_usuario=departamento.id_departamento ";
                
         if($tipo===1){
         $sql .=" AND departamento.id_departamento='".$id_departamento."' ";
         }else{
         $sql .= " AND usuario.tipo_usuario > 1 ";
         }      
      
  //      print_r($sql);
        
        $result=mysqli_query($con,$sql);

        return $result;
    }
    
		
}


