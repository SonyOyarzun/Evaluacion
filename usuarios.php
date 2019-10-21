<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connecta a BD*/
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
        include './Clases/Genero.php';
        include './Clases/TipoUsuario.php';
        include './Clases/Departamento.php';
	$active_usuarios="active";	
	$title="Usuarios | Evaluacion";      
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php 
        include("head.php");
        ?>
      
  </head>
  <body>
 	<?php
	include("navbar.php");
            //validar privilegios
         if($tipo_usuario>2){

        }else{
           header("location: notificaciones.php");  
        }
        
	?> 
      <div class="container" style="width: 90%">
		<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevo_usuario"><span class="glyphicon glyphicon-plus" ></span> Nuevo Usuario</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Usuarios</h4>
		</div>			
			<div class="panel-body">
			<?php
			include("modal/registro_usuario.php");
			include("modal/editar_usuario.php");
			include("modal/cambiar_clave.php");
			?>
			<form class="form-horizontal" role="form">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombres:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre" onkeyup='load(1);'>
							</div>
							
						</div>
	
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->			
			</div>
		</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
        <script type="text/javascript" src="js/funciones/usuario.js"></script>
        <script type="text/javascript" src="js/usuarios_page.js"></script>
        <script type="text/javascript" src="js/extras/validarRut.js"></script>
  </body>
</html>
