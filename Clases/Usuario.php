<?php

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
    function recuperarUsuario(Usuario $usuario) {

        $rut        = $usuario->getRut();
        $condicion  = $usuario->getCondicion();
        $offset     = $usuario->getOffset();
        $per_page   = $usuario->getPer_page();  
        $con        = $usuario->getCon();
        
        $sTable = " usuario, genero, tipo, departamento ";
        $sWhere = " WHERE usuario.genero_usuario = id_genero "
                . " AND  usuario.tipo_usuario = tipo.id_tipo "
                . " AND  usuario.departamento_usuario = departamento.id_departamento ";
       
      
   
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if ($rut!=""){ 
           $sWhere .= " AND usuario.id_usuario = '$rut' " ;
        }
        
        $sWhere.=" ORDER BY usuario.id_usuario DESC ";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = mysqli_query($con, $sql);
 //     print_r($sql);
        return $result;
    }

      function registrarUsuario(Usuario $usuario){
      
      $rut          = $usuario->getRut();
      $nombre       = $usuario->getNombre();
      $apellido     = $usuario->getApellido();
      $clave_hash   = $usuario->getClave();
      $email        = $usuario->getMail();
      $tipo         = $usuario->getTipo_usuario();
      $genero       = $usuario->getGenero();
      $departamento = $usuario->getDepartamento();
      $con          = $usuario->getCon();
              
      $fechaAgregado=date("Y-m-d H:i:s");
        
      $sql = "INSERT INTO usuario " 
           . " (id_usuario, nombre_usuario, apellido_usuario , clave_usuario, mail_usuario, fecha_agregado, tipo_usuario , genero_usuario, departamento_usuario) "
           . " VALUES('".$rut."','".$nombre."','".$apellido."','" . $clave_hash . "', '" . $email . "', '" . $fechaAgregado . "','".$tipo."' ,'".$genero."','".$departamento."')";
      
    //  print_r($sql);
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
     function editarUsuario(Usuario $usuario){
         
      $rut          = $usuario->getRut();
      $nombre       = $usuario->getNombre();
      $apellido     = $usuario->getApellido();
      $email        = $usuario->getMail();
      $tipo         = $usuario->getTipo_usuario();
      $genero       = $usuario->getGenero();
      $departamento = $usuario->getDepartamento();
      $con          = $usuario->getCon(); 
         
        $sql="UPDATE usuario "
            ."SET nombre_usuario='".$nombre."', apellido_usuario='".$apellido."', mail_usuario ='".$email."', "
            ."tipo_usuario='".$tipo."', genero_usuario='".$genero."', departamento_usuario='".$departamento."' "
            ."WHERE id_usuario='".$rut."';";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
     function editarClave(Usuario $usuario){
         
        $rut    = $usuario->getRut();
        $clave  = $usuario->getClave();
        $con    = $usuario->getCon();
        
        $sql = "UPDATE usuario SET clave_usuario='".$clave."' WHERE id_usuario='".$rut."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    function eliminarUsuario(Usuario $usuario){
        
        $rut    = $usuario->getRut();
        $con    = $usuario->getCon();
        
        $sql="DELETE FROM usuario WHERE id_usuario='".$rut."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
 

    function verificarUsuarioPorEvaluar(Historial $historial, Departamento $departamento, Encuesta $encuesta){
        
       $id_asignacion   = $historial    ->getId_asignacion();
       $id_departamento = $departamento ->getId();
       $tipo            = $encuesta     ->getTipo();
       $con             = $encuesta     ->getCon();

        
         $Excep = " SELECT usuario.id_usuario "
                . " FROM historial,usuarioencuesta,usuario "
                . " WHERE usuario.id_usuario=historial.id_evaluado "
                . " AND usuarioencuesta.id_asignacion=historial.id_asignacion "
                . " AND historial.id_asignacion = '$id_asignacion' ";
                                             
        
         $sql = " SELECT usuario.id_usuario,usuario.nombre_usuario,usuario.apellido_usuario "
                . " FROM usuario, departamento, tipo " 
                . " WHERE usuario.tipo_usuario=tipo.id_tipo "
                . " AND usuario.id_usuario not in($Excep) "
                . " AND usuario.departamento_usuario=departamento.id_departamento ";
                
         if($tipo===1){
         $sql .=" AND departamento.id_departamento='".$id_departamento."' ";
         }else{
         $sql .= " AND usuario.tipo_usuario > 1 ";
         }      
      
    //    print_r($sql);
        
        $result=mysqli_query($con,$sql);

        return $result;
    }
    
		
}


