<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre'])
		){

		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Pregunta.php';
                $con = Conexion::conectar();
                
		$id_pregunta=intval($_POST['mod_id']);
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));

		
                $pregunta = new Pregunta();
                $pregunta->setId($id_pregunta);
                $pregunta->setNombre($nombre);
                $pregunta->setDescripcion($descripcion);
                
		$query_update = Pregunta::editarPregunta($pregunta);
                
			if ($query_update){
				$messages[] = "Pregunta ha sido actualizada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
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
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>