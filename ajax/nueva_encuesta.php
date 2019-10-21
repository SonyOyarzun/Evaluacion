<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

/* Inicia validacion del lado del servidor */
if (empty($_POST['nombre'])) {
    $errors[] = "Nombre vacío";
}elseif (empty($_POST['tipo_encuesta'])) {
    $errors[] = "Tipo vacío";    
} else {
    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Encuesta.php';

    $nombre = mysqli_real_escape_string($con, (strip_tags($_POST["nombre"], ENT_QUOTES)));
    $tipo_encuesta = intval($_POST["tipo_encuesta"]);
    $fecha_agregado = date("Y-m-d H:i:s");

    $encuesta = new Encuesta();
    $encuesta->setNombre($nombre);
    $encuesta->setTipo($tipo_encuesta);
    $encuesta->setCon($con);
    
    $query_encuesta = Encuesta::registrarEncuesta($encuesta);

    if ($query_encuesta) {
        $messages[] = "La Encuesta ha sido creada con éxito.";
    } else {
        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
}

if (isset($errors)) {
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
    if (isset($messages)) {
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