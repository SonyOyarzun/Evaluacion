<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if (!isset($_GET['nombre_encuesta'])) {
    header("location: encuesta.php");
}

require_once ("config/conexion.php"); //Contiene funcion que conecta a la base de datos

$con = Conexion::conectar();

$active_notificaciones = "active";
$title = " Evaluacion | Owl Evaluation";
$id_encuesta = $_GET['id_encuesta'];
$nombre_encuesta = $_GET['nombre_encuesta'];
$tipo_encuesta = $_GET['tipo_encuesta'];
$id_asignacion = $_GET['id_asignacion'];
$id_usuario = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<?php include("./head.php"); ?>
    </head>
    <body>
<?php
include("./navbar.php");

$usuario = new Usuario();
$usuario->setId($id_usuario);

$recuperar_Asignacion = Encuesta::recuperarEncuestaAsignada($usuario);
$verificacion = mysqli_fetch_array($recuperar_Asignacion);
//valida que la encuesta por url sea la asignada
if ($id_encuesta != $verificacion['id_encuesta']) {
    header("location: notificaciones.php");
}
//      print_r($verificacion);
?>


        <div class="container">
            <div class="panel panel-success">
                <div class="panel-body">
                    <h1 style="text-align: center"><?php echo'Nombre de Encuesta: ' . $nombre_encuesta; ?></h1>  
                </div>
                <div class="panel-heading">

                </div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" id="guardar_evaluacion">
                        <input type="hidden" id="id_encuesta"     name="id_encuesta"     value="<?php echo $id_encuesta;     ?>" > 
                        <input type="hidden" id="nombre_encuesta" name="nombre_encuesta" value="<?php echo $nombre_encuesta; ?>" > 
                        <input type="hidden" id="tipo_encuesta"   name="tipo_encuesta"   value="<?php echo $tipo_encuesta;   ?>" > 
                        <input type="hidden" id="id_asignacion"   name="id_asignacion"   value="<?php echo $id_asignacion;   ?>" > 

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
        <script type="text/javascript" src="./js/evaluacion_page.js"></script>



    </body>
</html>
