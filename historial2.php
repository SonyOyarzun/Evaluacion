<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
        if (!isset($_GET['nombre_encuesta'])){
        header("location: encuesta.php");       
        }

	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_historial="active";
	$title=" Historial | Owl Evaluation";
        
        $id_encuesta=$_GET['id_encuesta'];
        $nombre_encuesta=$_GET['nombre_encuesta'];
    
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
        if($tipo_usuario>2){
            
        }else{
           header("location: notificaciones.php");  
        }
	?>
      
      
    <div class="container" >
	<div class="panel panel-success">
            <div class="panel-body">
                <h1 style="text-align: center"><?php echo'Nombre de Encuesta: '.$nombre_encuesta; ?></h1>  
            </div>
                         
            
		<div class="panel-heading">
      
		    <div class="btn-group pull-right">
			
  
			</div>
		
		</div>
            
		<div class="panel-body">
		
			
			
			<?php          
                                include("modal/detalle_evaluado.php");
                                include("modal/detalle_fechaEval.php");
			?>
			<form class="form-horizontal" role="form" id="historial2">
                         <div class="row">
                                
                                <div class='col-md-3 text-center'>
                                    <label>Filtrar por Evaluado </label>
                                    <input type="text" class="form-control text-center" id="q" placeholder="Id Evaluado" onkeyup='load(1);'>
                                </div>

                              <div class='col-md-4 text-center'>
                                     <label>Fecha inicio</label>
                                     <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" onchange="load(1);">
                                </div>
                                <div class='col-md-5 text-center'>
                                    <label>Fecha termino </label>
                                    <input class="form-control" type="date" name="fecha_termino" id="fecha_termino" onchange="load(1);">
                                </div>

                        
                            </div>
                        
                            <input type="hidden" id="id_encuesta" name="id_encuesta" value="<?php echo $id_encuesta; ?>" > 
                            <input type="hidden" id="nombre_encuesta" name="nombre_encuesta" value="<?php echo $nombre_encuesta; ?>" >
                     
			
				<!-- el select de la bd se carga en los div -->
                    
		<div id="resultados_evaluacion"></div><!-- Carga los datos ajax -->
		<div class='outer_div'></div><!-- Carga los datos ajax -->
				
			</form>
		
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("./footer.php");
	?>
        
         <!-- el select proviene de js -->
         <script type="text/javascript" src="./js/funciones/evaluacion.js"></script>
         <script type="text/javascript" src="./js/calificacion_page.js"></script>
    
         <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
         <script type="text/javascript" src="./js/extras/graficoBarra.js"></script>
              <script>
              grafico(1)
              grafico(2)
             </script>  
             <script type="text/javascript" src="./js/extras/enviarMail.js"></script>
 
  </body>
</html>
