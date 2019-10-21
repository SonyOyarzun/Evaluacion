<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_pregunta'])) {
           $errors[] = "No ha seleccionado preguntas";
        }else{
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Calificacion.php';
                include '../Clases/Historial.php';
                include '../Clases/Encuesta.php';
                include '../Clases/Usuario.php';
                include '../Clases/Departamento.php';
                //cantidad de preguntas de una encuesta
                $cantidad= intval($_POST["dinamico"]);
                $id_encuesta= intval($_POST["id_encuesta"]);
                $nombre_encuesta = strval($_POST["nombre_encuesta"]);
                $tipo_encuesta = intval($_POST["tipo_encuesta"]);
                $id_departamento = $_SESSION['departamento_usuario'];
                  //valores constantes
                $id_asignacion= intval($_POST["id_asignacion"]);
                $id_usuario = strval($_SESSION["id_usuario"]);
                $id_evaluado= strval($_POST["t_evaluar"]);
                $comentario_final = strval($_POST["comentario_final"]);
                
                //arreglo
                $pregunta = $_POST["id_pregunta"];
                $comentario = $_POST["comentario_pregunta"];
               
               
		$fecha_agregado=date("Y-m-d H:i:s");
                

              
           
                
                 for ($indice = 0; $indice < $cantidad; $indice++) {
                //preguntas,calificaciones y comentarios   
                    $notas = intval($_POST['calificacion'.$indice]);
                    
                    $calificacion = new Calificacion();
                    $calificacion->setId_pregunta($pregunta[$indice]);
                    $calificacion->setId_usuario($id_usuario);
                    $calificacion->setId_evaluado($id_evaluado);
                    $calificacion->setCalificacion_nota($notas);
                    $calificacion->setComentario_calificacion($comentario[$indice]);
                    $calificacion->setCon($con);

                    $comprobar = Calificacion::registrarCalificacion($calificacion);
                if($indice==($cantidad-1)){   
                if ($comprobar){
                       $messages[] = "Las respuestas se han ingresado satisfactoriamente ";
                    } else {
         
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    
                    }   
                }
                 }
                //comentario final

                    $calificacion = new Calificacion();
                    $calificacion->setId_usuario($id_usuario);
                    $calificacion->setId_evaluado($id_evaluado);
                    $calificacion->setComentario_calificacion($comentario_final);
                    $calificacion->setCon($con);
                
                    $encuesta = new Encuesta();
                    $encuesta->setId($id_encuesta); 
                    
                    $comprobar = Calificacion::registrarComentarioGeneral($calificacion,$encuesta);
                    
                if ($comprobar){
                       $messages[] = "El comentario se ha ingresado satisfactoriamente ";
                    } else {
         
                        $errors[] = "Lo sentimos , el comentario general no se ha registrado";
                    
                    }   
  
                //historial
                   
                    $historial = new Historial();
                    $historial->setId_asignacion($id_asignacion);
                    $historial->setId_encuesta($id_encuesta);
                    $historial->setId_usuario($id_usuario);
                    $historial->setId_evaluado($id_evaluado);
                    $historial->setNombre_encuesta($nombre_encuesta);
                    $historial->setTipo_encuesta($tipo_encuesta);
                    $historial->setCon($con);
                    
                    $comprobar = Historial::registrarHistorial($historial);
                    
                if ($comprobar){
                       $messages[] = "El historial se ha registrado satisfactoriamente ";
                    } else {
         
                        $errors[] = "Lo sentimos , el historial no se logro registrar.";
                    
                    }   
  //verificar cuantos usuarios quedan a evaluar, si es 0 se da por terminada la encuesta
                    
                $historial      = new Historial();
                $historial      ->setId_asignacion($id_asignacion);
                
                $departamento   = new Departamento();
                $departamento   ->setId($id_departamento);
                
                $encuesta       = new Encuesta();
                $encuesta       ->setTipo($tipo_encuesta);
                $encuesta       ->setCon($con);
    
                $query = Usuario::verificarUsuarioPorEvaluar($historial,$departamento,$encuesta);
                $count=mysqli_num_rows($query);
  //              print_r("contador :".$count." tipo: ".$tipo_encuesta." departamento".$id_departamento." asignacion".$id_asignacion);
                
                if ($count==0){
                 
                    
                       //actualizar estado de adignacion de encuesta 
                $encuesta = new Encuesta();
                $encuesta->setId_asignnacion($id_asignacion);
                $encuesta->setCon($con);
                
                $comprobar = Encuesta::encuestaCompletada($encuesta);
                    
                if ($comprobar){
                       $messages[] = "Encuesta asignada completada exitosamente ";
                    } else {
         
                        $errors[] = "Lo sentimos , la encuesta no se ha completado por alguna razon.";
                    
                    }
                        
                    }
                }
                 
                
                
                
           
		
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo '<br>'.$error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo '<br>'.$message;
								}
							?>
				</div>
				<?php
			}
                        
                        //volver
                        ?>
                   <meta http-equiv="refresh" content="1; url=notificaciones.php">

