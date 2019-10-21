<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Encuesta.php';
include '../Clases/Usuario.php';

$con = Conexion::conectar();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {

    // escaping, additionally removing everything that could be (html/javascript-) code
    $id_usuario = $_SESSION['id_usuario'];
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $fecha_inicio = mysqli_real_escape_string($con, (strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));
    $fecha_termino = mysqli_real_escape_string($con, (strip_tags($_REQUEST['fecha_termino'], ENT_QUOTES)));


    $aColumns = array('nombre_encuesta', 'nombre_encuesta'); //Columnas de busqueda

    $sWhere = "";


    $sWhere .= " AND (";
    for ($i = 0; $i < count($aColumns); $i++) {
        $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';

    if (($fecha_inicio && $fecha_termino) != "") {
        $sWhere .= " AND usuarioencuesta.fecha_agregado BETWEEN '$fecha_inicio' AND '$fecha_termino' ";
    }

    $usuario = new Usuario();
    $usuario->setId($id_usuario);
    $usuario->setCondicion($sWhere);

    $result = Encuesta::recuperarEncuestaAsignada($usuario);

    $numrows = mysqli_num_rows($result);
    $query = $result;

    if ($numrows > 0) {
        ?>

        <?php
        $nums = 1;
        while ($row = mysqli_fetch_array($query)) {
            $id_encuesta = $row['id_encuesta'];
            $id_asignacion = $row['id_usuario_encuesta'];
            $nombre_encuesta = $row['nombre_encuesta'];
            $tipo_encuesta = $row['tipo_encuesta'];
            $nombre_tipo_encuesta = $row['nombre_tipo_encuesta'];
            $fecha_agregado = $row['fecha_usuario_encuesta'];
            $estado = $row['nombre_estado_asignacion'];
            ?>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 thumb text-center ng-scope" ng-repeat="item in records">
                <a class="thumbnail" href="evaluaciones.php?id_encuesta=<?php echo $id_encuesta; ?>&tipo_encuesta=<?php echo $tipo_encuesta; ?>&nombre_encuesta=<?php echo $nombre_encuesta; ?>&id_asignacion=<?php echo $id_asignacion; ?>">

                    <img class="img-responsive" src="img/encuesta.png" alt="<?php echo $comentario_encuesta; ?>">

                </a>
                <span class="thumb-name"><strong><?php echo $nombre_encuesta; ?></strong></span>
                <span class="thumb-code ng-binding"><?php echo $fecha_agregado; ?></span>
                <span class="thumb-name"><strong><?php echo $nombre_tipo_encuesta; ?></strong></span>
                <span class="thumb-code ng-binding"><?php echo $estado; ?></span>
            </div>
            <?php
            if ($nums % 6 == 0) {
                echo "<div class='clearfix'></div>";
            }
            $nums++;
        }
        ?>

        <?php
    }
}
?>
