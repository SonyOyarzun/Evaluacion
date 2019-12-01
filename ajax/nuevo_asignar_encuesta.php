<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
include ($_SERVER["DOCUMENT_ROOT"].'/Mail/email.php');	
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['seleccion'])) {
           $errors[] = "No ha seleccionado usuarios";
        }else{
		
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Encuesta.php';
                include '../Clases/Usuario.php';
                $con = Conexion::conectar();
                
		$id_encuesta= intval($_POST["id_encuesta"]);
                $nombre_encuesta= strval($_POST["nombre_encuesta"]);
                foreach ($_POST['seleccion'] as $seleccion){
                $array = explode(",", $seleccion);
                $id_usuario=$array[0];
                $mail=$array[1];

                $usuario = new Usuario();
                $usuario->setId($id_usuario);
              
                $encuesta = new Encuesta();
                $encuesta->setId($id_encuesta);

                $count= mysqli_num_rows(Encuesta::verificarAsignarEncuesta($usuario,$encuesta));
                if ($count>0){
                       $errors[] = "<br>La Encuesta Ya ha sido a signada este periodo a : ".$id_usuario;
                    } else {
              
                $query_asignar = Encuesta::asignarEncuesta($usuario,$encuesta);
                   if ($query_asignar) {
                        $messages[] = "La Encuesta ha sido asignada con éxito a : ".$id_usuario;
                        
                    //obtenemos al evaluado
                       $result= Usuario::recuperarUsuario($usuario);
                       $arreglo=mysqli_fetch_array($result);
                       $evaluado=$arreglo['nombre_usuario'];
                       $destino=$arreglo['mail_usuario'];
                       
                   //obtenemos al asignador
                       $evaluador=$_SESSION['nombre_usuario'];
                       $tipocorreo=1;
                    //predeterminado en clase mail, tipo 1 asigna y tipo 2 cita
         
                       $mail = new Mail(); 
                       $mail->setEvaluado($evaluado);
                       $mail->setEvaluador($evaluador);
                       $mail->setTipo($tipocorreo);
                       $mail->setDestino($destino);
                       $mail->setEncuesta($nombre_encuesta);
               
                       Mail::enviarMail($mail);
                        
                        
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
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

?>