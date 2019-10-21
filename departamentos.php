<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_departamentos="active";
	$title=" Departamentos | Owl Evaluation";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
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
	
    <div class="container">
	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevo_departamento"><span class="glyphicon glyphicon-plus" ></span> Nuevo departamento </button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Departamento</h4>
		</div>
		<div class="panel-body">
			<?php
				include("modal/registro_departamento.php");
				include("modal/editar_departamento.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombre</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre del departamento" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
	
			</form>

                    <!-- el select de la bd se carga en los div -->
                    
		<div id="resultados"></div><!-- Carga los datos ajax -->
		<div class='outer_div'></div><!-- Carga los datos ajax -->		
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
        
         <!-- el select proviene de js -->
          <script type="text/javascript" src="js/funciones/departamento.js"></script>
         <script type="text/javascript" src="js/departamento_page.js"></script>       
  </body>
</html>
