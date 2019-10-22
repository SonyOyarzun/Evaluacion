<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

/* Inicia validacion del lado del servidor */
if (empty($_POST['id_pregunta'])) {
    $errors[] = "No ha seleccionado preguntas";
}else if (empty($_POST["t_evaluar"])) {
    $errors[] = "No ha seleccionado trabajador a evaluar";    
} else {

    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Calificacion.php';
    include '../Clases/Historial.php';
    include '../Clases/Encuesta.php';
    include '../Clases/Usuario.php';
    include '../Clases/Departamento.php';
    //cantidad de preguntas de una encuesta
    $cantidad = intval($_POST["dinamico"]);
    $id_encuesta = intval($_POST["id_encuesta"]);
    $nombre_encuesta = strval($_POST["nombre_encuesta"]);
    $tipo_encuesta = intval($_POST["tipo_encuesta"]);
    $id_departamento = $_SESSION['departamento_usuario'];
    //valores constantes
    $id_asignacion = intval($_POST["id_asignacion"]);
    $id_usuario = strval($_SESSION["id_usuario"]);
    $id_evaluado = strval($_POST["t_evaluar"]);
    $comentario_final = strval($_POST["comentario_final"]);

    //arreglo
    $pregunta = $_POST["id_pregunta"];
    $comentario = $_POST["comentario_pregunta"];


    $fecha_agregado = date("Y-m-d H:i:s");

    $comprobar;

    for ($indice = 0; $indice < $cantidad; $indice++) {
        //preguntas,calificaciones y comentarios   
        $notas = intval($_POST['calificacion' . $indice]);

        $calificacion = new Calificacion();
        $calificacion->setPregunta($pregunta[$indice]);
        $calificacion->setUsuario($id_usuario);
        $calificacion->setEvaluado($id_evaluado);
        $calificacion->setNota($notas);
        $calificacion->setComentario($comentario[$indice]);

        $comprobar = Calificacion::registrarCalificacion($calificacion);
    }

    if ($comprobar) {
        $messages[] = "Las respuestas se han ingresado satisfactoriamente ";

        //comentario final

        $calificacion = new Calificacion();
        $calificacion->setUsuario($id_usuario);
        $calificacion->setEvaluado($id_evaluado);
        $calificacion->setComentario($comentario_final);

        $encuesta = new Encuesta();
        $encuesta->setId($id_encuesta);

        $comprobar = Calificacion::registrarComentarioGeneral($calificacion, $encuesta);

        if ($comprobar) {
     //       $messages[] = "El comentario se ha ingresado satisfactoriamente ";

            //historial

            $historial = new Historial();
            $historial->setAsignacion($id_asignacion);
            $historial->setEncuesta($id_encuesta);
            $historial->setUsuario($id_usuario);
            $historial->setEvaluado($id_evaluado);
            $historial->setNombre_encuesta($nombre_encuesta);
            $historial->setTipo_encuesta($tipo_encuesta);

            $comprobar = Historial::registrarHistorial($historial);

            if ($comprobar) {
          //      $messages[] = "El historial se ha registrado satisfactoriamente ";

                //verificar cuantos usuarios quedan a evaluar, si es 0 se da por terminada la encuesta

                $historial = new Historial();
                $historial->setAsignacion($id_asignacion);

                $departamento = new Departamento();
                $departamento->setId($id_departamento);

                $encuesta = new Encuesta();
                $encuesta->setTipo($tipo_encuesta);

                $query = Usuario::verificarUsuarioPorEvaluar($historial, $departamento, $encuesta);
                $count = mysqli_num_rows($query);
       //         print_r("contador :".$count." tipo: ".$tipo_encuesta." departamento".$id_departamento." asignacion".$id_asignacion);

                if ($count == 0) {


                    //actualizar estado de adignacion de encuesta 
                    $encuesta = new Encuesta();
                    $encuesta->setAsignacion($id_asignacion);

                    $comprobar = Encuesta::encuestaCompletada($encuesta);

                    if ($comprobar) {
                        $messages[] = "Usted ha evaluado a todo su equipo";
                    } else {

                        $errors[] = "Lo sentimos , la encuesta no se ha completado por alguna razon.";
                    }
                }
            } else {

                $errors[] = "Lo sentimos , el historial no se logro registrar.";
            }
        } else {

            $errors[] = "Lo sentimos , el comentario general no se ha registrado";
        }
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
        echo '<br>' . $error;
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
        echo '<br>' . $message;
    }
    ?>
    </div>
        <?php
    }

    ?>


