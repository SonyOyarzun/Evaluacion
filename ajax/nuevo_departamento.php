<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){

		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Departamento.php';
	        $con = Conexion::conectar();
                
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		
                $departamento = new Departamento();
                $departamento->setNombre($nombre);
                $departamento->setDescripcion($descripcion);

		$query_new_insert = Departamento::registrarDepartamento($departamento);
			if ($query_new_insert){
				$messages[] = "Departamento ha sido ingresada satisfactoriamente.";
			} else{
				$errors []= "El nombre del departamento ya existe.".mysqli_error($con);
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