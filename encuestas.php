<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	include './Clases/TipoEncuesta.php';
        
	$active_encuestas="active";
	$title="Encuestas | Owl Evaluation";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("./head.php");?>
  </head>
  <body>
	<?php
	include("./navbar.php");
          //validar privilegios
        if($tipo_usuario>1){
            
        }else{
           header("location: notificaciones.php");  
        }
	?>
	
    <div class="container">
	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nueva_encuesta"><span class="glyphicon glyphicon-plus" ></span> Nueva Encuesta </button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Encuestas Creadas </h4>
		</div>
		<div class="panel-body">

			<?php
			include("./modal/registro_encuesta.php");
			include("./modal/editar_encuesta.php");
			?>
                    
			<form class="form-horizontal" role="form" id="datos">
				
						
                            <div class="row">
                                
                                <div class='col-md-4'>
                                    <label>Filtrar por nombre </label>
                                    <input type="text" class="form-control" id="q" placeholder="Nombre de encuesta" onkeyup='load(1);'>
                                </div>

                        
                         
                                <div class='col-md-3'>
                                     <label>Fecha inicio</label>
                                     <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" onchange="load(1);">
                                </div>
                                <div class='col-md-3'>
                                    <label>Fecha termino </label>
                                    <input class="form-control" type="date" name="fecha_termino" id="fecha_termino" onchange="load(1);">
                                </div>



                                <!--se carga el icono de productos --->
                                <div class='col-md-12 text-center'>
                                    <span id="loader"></span>
                                </div>
                            </div>
				<hr>
				<div class='row-fluid'>
					<div id="resultados"></div><!-- Carga los datos ajax -->
				</div>	
				<div class='row'>
					<div class='outer_div'></div><!-- Carga los datos ajax -->
				</div>
			</form>
				
			
		
	
			
			
			
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("./footer.php");
	?>
        <script type="text/javascript" src="./js/funciones/encuesta.js"></script>
        <script type="text/javascript" src="./js/encuesta_page.js"></script>
  </body>
</html>

