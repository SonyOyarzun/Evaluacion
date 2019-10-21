<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
require_once ("config/conexion.php"); //Contiene funcion que conecta a la base de datos
include './Clases/Pregunta.php';

$active_encuestas = "active";
$title = "Preguntas | Owl Evaluation";
if (!isset($_GET['tipo_encuesta']) || !isset($_GET['id_encuesta']) || !isset($_GET['nombre_encuesta'])) {
    header("location: notificaciones.php");
}
$tipo = $_GET['tipo_encuesta'];
$id_encuesta = $_GET['id_encuesta'];
$nombre_encuesta = $_GET['nombre_encuesta'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<?php include("head.php"); ?>
    </head>
    <body>
<?php
include("navbar.php");
include("modal/registro_pregunta.php");
include("modal/editar_pregunta.php");
include("modal/registro_asignarGeneral.php");
include("modal/registro_asignarJefatura.php");
//validar privilegios
if ($tipo_usuario > 1) {
    
} else {
    header("location: notificaciones.php");
}
?>
        <input type="hidden" id="id_encuesta" name="id_encuesta" value="<?php echo $id_encuesta; ?>" >    
        <div class="container">
            <div class="panel panel-success">
                <div class="panel-body">
                    <h1 style="text-align: center"><?php echo'Nombre de Encuesta: ' . $nombre_encuesta; ?></h1>  


                </div>
                <div class="panel-heading">
                   
                    <div class="btn-group col-md-5 ">
<?php
if ($tipo_usuario > 2) {
    ?>
                            <button type='button' class="btn btn-danger" onclick="eliminarEncuesta('<?php echo $id_encuesta; ?>')"><span class="glyphicon glyphicon-trash" ></span> Eliminar Encuesta </button>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <div class="btn-group  col-md-5 ">
<?php
if ($tipo == 1) {
    ?>    
                            <button type='button' class="btn btn-primary" data-toggle="modal" data-target="#asignar_encuestaG"><span class="glyphicon glyphicon-share" ></span> Asignar Encuesta </button>
                            <?php
                        } else {
                            ?>
                            <button type='button' class="btn btn-primary" data-toggle="modal" data-target="#asignar_encuestaJ" onclick="recuperarUsuarioDepartamento(0)"><span class="glyphicon glyphicon-share" ></span> Asignar Encuesta </button>
                            <?php
                        }
                        ?>   
                    </div>
                    
                     <div class="btn-group">
                        <button type='button' class="btn btn-success" data-toggle="modal" data-target="#nueva_pregunta"><span class="glyphicon glyphicon-plus" ></span> Nueva Pregunta </button>
                    </div>
                    
                    <h4><i class='glyphicon glyphicon-search'></i> Buscar Pregunta </h4>
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" id="datos_cotizacion">

                        <div class="form-group row">
                            <label for="q" class="col-md-2 control-label">Nombre</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="q" placeholder="Titulo de la Pregunta" onkeyup='load(1);'>
                            </div>
                        </div>



                    </form>


                    <!-- el select de la bd se carga en los div -->

                    <div id="resultados2"></div><!-- Carga los datos ajax -->
                    <div class='outer_div'></div><!-- Carga los datos ajax -->






                </div>
            </div>

        </div>
        <hr>
<?php
include("footer.php");
?>

        <!-- el select proviene de js -->
        <script type="text/javascript" src="js/funciones/encuesta.js"></script>
        <script type="text/javascript" src="js/funciones/pregunta.js"></script>
        <script type="text/javascript" src="js/funciones/usuario.js"></script>
        <script type="text/javascript" src="js/pregunta_page.js"></script> 

    </body>
</html>
